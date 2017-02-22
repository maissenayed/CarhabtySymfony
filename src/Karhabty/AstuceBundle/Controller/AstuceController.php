<?php

namespace Karhabty\AstuceBundle\Controller;

use Karhabty\AstuceBundle\Entity\Rating;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Karhabty\AstuceBundle\Entity\Astuce;
use Karhabty\AstuceBundle\Entity\Comment;
use Karhabty\AstuceBundle\Entity\AstuceRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Karhabty\AstuceBundle\Form\AstuceType;
use Karhabty\AstuceBundle\Form\CommentType;
use Symfony\Component\HttpFoundation\Response;

class AstuceController extends Controller
{
    function addAstuceAction(Request $req)
    {
        $astuce = new Astuce();
        $astuce->setDate(new \DateTime());
        $form = $this->createForm(AstuceType::class, $astuce);
        if ($form->handleRequest($req)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($astuce);
            $em->flush();
            return $this->redirectToRoute('listAstuce');
        }
        return $this->render('KarhabtyAstuceBundle:Astuce:addAstuce.html.twig', array('form' => $form->createView()));
    }

    public function deleteAstuceAction(Request $request)
    {

        if($request->isXmlHttpRequest())
        {
            $id=$request->request->get('data');
        $em = $this->getDoctrine()->getManager();
        $Astuce = $em->getRepository('KarhabtyAstuceBundle:Astuce')->find($id);


        $em->remove($Astuce);
        $em->flush();
        return new JsonResponse(array('status'=>'success'));
        }
    }

    public function testAction($param)
    {
        return new Response($param);
    }

    public function listAstuceAction($param)
    {
        $em = $this->getDoctrine()->getManager();
        $sortOption=$param;
        if($sortOption=='ALL')
        {$Astuce = $em->getRepository('KarhabtyAstuceBundle:Astuce')->findAll();}
        else
        {$Astuce= $em->getRepository('KarhabtyAstuceBundle:Astuce')->findByTheme($sortOption) ;
        }
        return $this->render('KarhabtyAstuceBundle:Astuce:listAstuce.html.twig', array('astuces' => $Astuce));
    }

    public function updateAstuceAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $Astuce = $em->getRepository('KarhabtyAstuceBundle:Astuce')->find($id);
        $form = $this->createForm(AstuceType::class, $Astuce);
        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Astuce);
            $em->flush();
            return $this->redirectToRoute('listAstuce');
        }
        return $this->render('KarhabtyAstuceBundle:Astuce:updateAstuce.html.twig', array('form' => $form->createView()));
    }



    public function rateAction(Request $request)
    {
        $idp = $request->get('idp');
        $em = $this->getDoctrine()->getManager();
        $pub = $em->getRepository('KarhabtyAstuceBundle:Astuce')->find($idp);

        $rate = $em->getRepository('KarhabtyAstuceBundle:Rating')->findOneBy(array('user'=>$this->getUser(),'astuce'=>$pub));
        if ($rate == null)
            $rate = new Rating();
        $user = $this->getUser();

        $num = $request->get('rate');

        $rate->setUser($user);


        $rate->setIdAstuce($pub);
        $rate->setValue($num);
        $em->persist($rate);

        $em->flush();
        $rate2 = $em->getRepository('KarhabtyAstuceBundle:Rating')->findOneBy(array('user'=>$this->getUser(),'astuce'=>$pub));
        return new Response("ok");

    }








    public function getCommentsAction(Request $request)
    {


        $astuce=$this->getDoctrine()->getRepository('KarhabtyAstuceBundle:Astuce')->find($request->request->get('id'));
        $listComm=$this->getDoctrine()->getRepository('KarhabtyAstuceBundle:Comment')->findByAstuce($astuce);
        $htmlList=[];
        foreach ($listComm as $com)
        {
            $var=$com->getCommentaire();
            array_push($htmlList,$var);
        }

        return new JsonResponse(array("data"=>$htmlList));
    }






    public function infoAstuceAction(Request $req)
    {


        $idp = $req->get('id');

        #Signle Astuce
        $ba3 = $this->getDoctrine()
            ->getRepository('KarhabtyAstuceBundle:Astuce')
            ->find($idp);


        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        if ($form->handleRequest($req)->isValid()) {
            $comment->setUser($this->getUser());
            $comment->setAstuce($ba3);
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
        }
        if (!$ba3) {
            throw $this->createNotFoundException(
                'No astuce found for id '
            );
        }
        #RecentProduct
        $currentAstuce1 = $ba3;
        $recentAstuce = $this->getDoctrine()
            ->getRepository('KarhabtyAstuceBundle:Astuce')
            ->recentAstuce($currentAstuce1->getDate());
        #relatedAstuce
        $currentAstuce = $ba3;
        $relatedAstuce = $this->getDoctrine()
            ->getRepository('KarhabtyAstuceBundle:Astuce')
            ->relatedAstuce($currentAstuce->getTheme());


        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $pub = $em->getRepository('KarhabtyAstuceBundle:Astuce')->findby(array('id'=>$idp));


        $rating = $em->getRepository('KarhabtyAstuceBundle:Rating')->findBy(array('astuce' => $pub,'user'=>$user));
        $rate = new Rating();
        if ($rating != null) {

            /*$rate->setValue($rating[3]);*/
            $keys = array_keys($rating);

            $rate->setValue($rating[$keys[0]]->getValue());


            if ($rate->getValue() != 0) {

                return ($this->render("KarhabtyAstuceBundle:Astuce:infoAstuce.html.twig"
                    , array('pub' => $pub, 'rate' => $rate,'i' => $ba3 , 'relatedAstuces' => $relatedAstuce , 'recentAstuces' => $recentAstuce,'form'=>$form->createView())));

            }

        } else {
            $rate->setValue(0);
            return ($this->render("KarhabtyAstuceBundle:Astuce:infoAstuce.html.twig"
                , array('pub' => $pub, 'rate' => $rate,'us'=>$user,'i' => $ba3 , 'relatedAstuces' => $relatedAstuce , 'recentAstuces' => $recentAstuce,'form'=>$form->createView())));

        }



    }
    public function themeAction($theme) {


        $astuce = $this->getDoctrine()
            ->getRepository('KarhabtyAstuceBundle:Astuce')
            ->findThemeAstucetDQL($theme);


        return ($this->render("KarhabtyAstuceBundle:Astuce:theme.html.twig"
            , array('modeles' => $astuce)));
    }
    function addCommentAction(Request $req)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        if ($form->handleRequest($req)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

        }
        return $this->render('KarhabtyAstuceBundle:Astuce:infoAstuce.html.twig', array('form' => $form->createView()));
    }




}