<?php

namespace Karhabty\AstuceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Karhabty\AstuceBundle\Entity\Astuce;
use Karhabty\AstuceBundle\Entity\Comment;
use Karhabty\AstuceBundle\Entity\AstuceRepository;
use Symfony\Component\HttpFoundation\Request;
use Karhabty\AstuceBundle\Form\AstuceType;
use Karhabty\AstuceBundle\Form\CommentType;

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

    public function deleteAstuceAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $Astuce = $em->getRepository('KarhabtyAstuceBundle:Astuce')->find($id);
        $em->remove($Astuce);
        $em->flush();
        return $this->redirect($this->generateUrl('listAstuce', array()));
    }

    public function listAstuceAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Astuce = $em->getRepository('KarhabtyAstuceBundle:Astuce')->findAll();
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

    public function infoAstuceAction(Request $req,$id)
    {


        #Signle Astuce
        $ba3 = $this->getDoctrine()
            ->getRepository('KarhabtyAstuceBundle:Astuce')
            ->find($id);


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
                'No astuce found for id ' . $id
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
        return ($this->render("KarhabtyAstuceBundle:Astuce:infoAstuce.html.twig"
            , array('i' => $ba3 , 'relatedAstuces' => $relatedAstuce , 'recentAstuces' => $recentAstuce,'form'=>$form->createView())));

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