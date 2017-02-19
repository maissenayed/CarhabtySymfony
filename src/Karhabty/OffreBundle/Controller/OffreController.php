<?php

namespace Karhabty\OffreBundle\Controller;

use Karhabty\OffreBundle\Entity\Offre;
use Karhabty\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class OffreController extends Controller
{

    public function indexAction()
    {

        $user = $this->getUser();
        $userId = $user->getId();
        $em = $this->getDoctrine()->getManager();
        $offres = $em->getRepository('KarhabtyOffreBundle:Offre')->MesOffres($userId);
        return $this->render('@KarhabtyOffre/offre/index.html.twig', array(
            'offres' => $offres,
        ));
    }


    public function getAlloffreAction()
    {

        $now = new \DateTime();
        $economie = 0;
        $em = $this->getDoctrine()->getManager();
        $offres = $em->getRepository('KarhabtyOffreBundle:Offre')->getoffres($now);


        return $this->render('KarhabtyOffreBundle:offre:Offres.html.twig', array(
            'offres' => $offres, 'eco' => $economie
        ));
    }


    public function newAction(Request $request)
    {
        $offre = new Offre();
        $offre->setUser($this->getUser());
        $form = $this->createForm('Karhabty\OffreBundle\Form\OffreType', $offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $em = $this->getDoctrine()->getManager();
            $em->persist($offre);
            $em->flush($offre);

            return $this->redirectToRoute('offre_index');
        }

        return $this->render('@KarhabtyOffre/offre/new.html.twig', array(
            'offre' => $offre,
            'form' => $form->createView(),
        ));
    }


    public function showAction(Offre $offre)
    {

        return $this->render('@KarhabtyOffre/offre/show.html.twig', array(
            'offre' => $offre

        ));
    }

    public function detailOffreAction(Offre $offre)
    {


        return $this->render('@KarhabtyOffre/offre/details.html.twig', array(
            'offre' => $offre

        ));
    }


    public function editAction(Request $request, Offre $offre)
    {
        $deleteForm = $this->createDeleteForm($offre);
        $editForm = $this->createForm('Karhabty\OffreBundle\Form\OffreType', $offre);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('offre_index');
        }

        return $this->render('@KarhabtyOffre/offre/edit.html.twig', array(
            'offre' => $offre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    public function deleteAction(Request $request, Offre $offre)
    {
        $form = $this->createDeleteForm($offre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($offre);
            $em->flush($offre);
        }

        return $this->redirectToRoute('offre_index');
    }


    private function createDeleteForm(Offre $offre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('offre_delete', array('id' => $offre->getIdOffre())))
            ->setMethod('DELETE')
            ->getForm();
    }




    function OffresPassesAction()
    {


        $now = new \DateTime();
        $em = $this->getDoctrine()->getManager();
        $offre = $em->getRepository('KarhabtyOffreBundle:Offre')->offrespasses($now);


        return $this->render('@KarhabtyOffre/offre/offresPasses.html.twig', array(
            'offres' => $offre

        ));

    }

    function CountAction(Request $request)
    {


        if ($request->isXmlHttpRequest()) {


            $id = $request->request->get('id');
            $em = $this->getDoctrine()->getManager();
            $count = $em->getRepository('KarhabtyOffreBundle:Offre')->countOffre($id);

            return new JsonResponse($count);
            }

             }







}