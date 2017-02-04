<?php

namespace Karhabty\AstuceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Karhabty\AstuceBundle\Entity\Astuce;
use Symfony\Component\HttpFoundation\Request;
use Karhabty\AstuceBundle\Form\AstuceType;

class AstuceController extends Controller
{
    function addAstuceAction(Request $req)
    {
        $astuce = new Astuce();
        $form = $this->createForm(AstuceType::class, $astuce);
        if ($form->handleRequest($req)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($astuce);
            $em->flush();
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
        return $this->render('KarhabtyAstuceBundle:Astuce:updateAstuce.html.twig',array('form' => $form->createView()));
    }
}
