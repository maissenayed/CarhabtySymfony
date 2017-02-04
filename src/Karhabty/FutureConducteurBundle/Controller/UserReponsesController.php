<?php

namespace Karhabty\FutureConducteurBundle\Controller;

use Karhabty\FutureConducteurBundle\Entity\UserReponses;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Userreponse controller.
 *
 * @Route("userreponses")
 */
class UserReponsesController extends Controller
{
    /**
     * Lists all userReponse entities.
     *
     * @Route("/", name="userreponses_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $userReponses = $em->getRepository('KarhabtyFutureConducteurBundle:UserReponses')->findAll();

        return $this->render('KarhabtyFutureConducteurBundle:userreponses:index.html.twig', array(
            'userReponses' => $userReponses,
        ));
    }

    /**
     * Creates a new userReponse entity.
     *
     * @Route("/new", name="userreponses_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $userReponse = new Userreponse();
        $form = $this->createForm('Karhabty\FutureConducteurBundle\Form\UserReponsesType', $userReponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($userReponse);
            $em->flush($userReponse);

            return $this->redirectToRoute('userreponses_show', array('id' => $userReponse->getId()));
        }

        return $this->render('KarhabtyFutureConducteurBundle:userreponses:new.html.twig', array(
            'userReponse' => $userReponse,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a userReponse entity.
     *
     * @Route("/{id}", name="userreponses_show")
     * @Method("GET")
     */
    public function showAction(UserReponses $userReponse)
    {
        $deleteForm = $this->createDeleteForm($userReponse);

        return $this->render('KarhabtyFutureConducteurBundle:userreponses:show.html.twig', array(
            'userReponse' => $userReponse,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing userReponse entity.
     *
     * @Route("/{id}/edit", name="userreponses_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, UserReponses $userReponse)
    {
        $deleteForm = $this->createDeleteForm($userReponse);
        $editForm = $this->createForm('Karhabty\FutureConducteurBundle\Form\UserReponsesType', $userReponse);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('userreponses_edit', array('id' => $userReponse->getId()));
        }

        return $this->render('KarhabtyFutureConducteurBundle:userreponses:edit.html.twig', array(
            'userReponse' => $userReponse,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a userReponse entity.
     *
     * @Route("/{id}", name="userreponses_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, UserReponses $userReponse)
    {
        $form = $this->createDeleteForm($userReponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($userReponse);
            $em->flush($userReponse);
        }

        return $this->redirectToRoute('userreponses_index');
    }

    /**
     * Creates a form to delete a userReponse entity.
     *
     * @param UserReponses $userReponse The userReponse entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(UserReponses $userReponse)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('userreponses_delete', array('id' => $userReponse->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
