<?php

namespace Karhabty\AnnonceBundle\Controller;

use Karhabty\AnnonceBundle\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Annonce controller.
 *
 */
class AnnonceController extends Controller
{
    /**
     * Lists all annonce entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $annonces = $em->getRepository('KarhabtyAnnonceBundle:Annonce')->findAll();

        return $this->render('@KarhabtyAnnonce/annonce/index.html.twig', array(
            'annonces' => $annonces,
        ));
    }
    public function publicannonceAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $querydate = $em->getRepository('KarhabtyAnnonceBundle:Annonce')
            ->findAllOrderedBydate();

        $prix = $request->request->get('prix');
        $title = $request->request->get('title');
        $cat = $request->request->get('category');



       if ($prix||$title||$cat) {


            $query = $em->getRepository('KarhabtyAnnonceBundle:Annonce')
                ->findAllOrderedByName($prix, $title, $cat);
            return $this->render('@KarhabtyAnnonce/annonce/recherche_avance.html.twig', array(
                'annonces' => $query,
                'related'=>$querydate,


            ));

        }






        $annonces = $em->getRepository('KarhabtyAnnonceBundle:Annonce')->findAll();

        return $this->render('@KarhabtyAnnonce/annonce/recherche.html.twig', array(
            'annonces' => $annonces,
            'related'=>$querydate,



        ));
    }

    /**
     * Creates a new annonce entity.
     *
     */
    public function newAction(Request $request)
    {
        $annonce = new Annonce();
        $form = $this->createForm('Karhabty\AnnonceBundle\Form\AnnonceType', $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonce->setAnneePub(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($annonce);
            $em->flush($annonce);

            return $this->redirectToRoute('annonce_show', array('id' => $annonce->getId()));
        }

        return $this->render('@KarhabtyAnnonce/annonce/new.html.twig', array(
            'annonce' => $annonce,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a annonce entity.
     *
     */
    public function showAction(Annonce $annonce)
    {
        $deleteForm = $this->createDeleteForm($annonce);

        return $this->render('@KarhabtyAnnonce/annonce/show.html.twig', array(
            'annonce' => $annonce,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing annonce entity.
     *
     */
    public function editAction(Request $request, Annonce $annonce)
    {
        $deleteForm = $this->createDeleteForm($annonce);
        $editForm = $this->createForm('Karhabty\AnnonceBundle\Form\AnnonceType', $annonce);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('annonce_edit', array('id' => $annonce->getId()));
        }

        return $this->render('@KarhabtyAnnonce/annonce/edit.html.twig', array(
            'annonce' => $annonce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a annonce entity.
     *
     */
    public function deleteAction(Request $request, Annonce $annonce)
    {
        $form = $this->createDeleteForm($annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($annonce);
            $em->flush($annonce);
        }

        return $this->redirectToRoute('annonce_index');
    }

    /**
     * Creates a form to delete a annonce entity.
     *
     * @param Annonce $annonce The annonce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Annonce $annonce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('annonce_delete', array('id' => $annonce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function rechercheAction(Request $request)
    {
        $form = $this->createForm('Karhabty\AnnonceBundle\Form\search');
        $form->handleRequest($request);



        $prix = $request->request->get('prix');
        $title = $request->request->get('title');
        $cat = $request->request->get('category');

        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('KarhabtyAnnonceBundle:Annonce')
            ->findAllOrderedByName($prix, $title, $cat);


        return $this->render('@KarhabtyAnnonce/annonce/recherche_avance.html.twig', array(
            'annonces' => $query,
        ));
    }




















}
