<?php

namespace Karhabty\EventsBundle\Controller;

use Karhabty\EventsBundle\Entity\Event;
use Karhabty\EventsBundle\Entity\UserEventParticipation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Event controller.
 *
 */
class EventController extends Controller
{

    public function indexAction(Request $request)
    {
        $criteria = $request->get('criteria');

        $eventService = $this->get('karhabty.event.service');

        switch ($criteria){
            case 'mine':
                $events = $eventService->findBy(array('user'=>$this->getUser()));
                break;
            case 'public':
                $events = $eventService->findBy(array('access'=>'public'));
                break;
            case 'private':
                $events = $eventService->findBy(array('access'=>'private'));
                break;
            case 'tri':
                $events = $eventService->findBy(array(),array('eventDate' => 'ASC'));
                break;
            default:
                $events = $eventService->findFutureEvents();break;
        }

        $data = array(
            'request' => array(),
            'accepted' => array(),
            'declined' => array(),
            'canceled' => array(),
        );
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if(is_object($user)) {
            $participationRequests = $eventService->findParticipationRequestsBy(array('user' => $user));
            if (is_array($participationRequests)) {
                foreach ($participationRequests as $element) {
                    if ($element->getStatus() === 'request') {
                        $data ['request'][] = $element->getEvent()->getId();
                    }
                    if ($element->getStatus() === 'accepted') {
                        $data ['accepted'][] = $element->getEvent()->getId();
                    }
                    if ($element->getStatus() === 'declined') {
                        $data ['declined'][] = $element->getEvent()->getId();
                    }
                    if ($element->getStatus() === 'canceled') {
                        $data ['canceled'][] = $element->getEvent()->getId();
                    }
                }
            }
        }


        return $this->render('KarhabtyEventsBundle:event:index.html.twig', array(
            'events' => $events,
            'participationRequests' => $data,
            'criteria' => $criteria,
        ));
    }

    /**
     * Creates a new event entity.
     *
     */
    public function newAction(Request $request)
    {
        $event = new Event();
        $form = $this->createForm('Karhabty\EventsBundle\Form\EventType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file
            $file = $event->getPhoto();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('brochures_directory'),
                $fileName
            );
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $event->setPhoto($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush($event);

            return $this->redirectToRoute('event_show', array('id' => $event->getId()));
        }

        return $this->render('KarhabtyEventsBundle:event:new.html.twig', array(
            'event' => $event,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     */
    public function showAction(Event $event)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $deleteForm = $this->createDeleteForm($event);

        $eventService = $this->get('karhabty.event.service');

        $participationRequests = $eventService->findParticipationRequestsBy(array('event'=>$event));

        return $this->render('KarhabtyEventsBundle:event:show.html.twig', array(
            'event' => $event,
            'delete_form' => $deleteForm->createView(),
            'participationRequests' => $participationRequests,
        ));
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     */
    public function editAction(Request $request, Event $event)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user->getId() !== $event->getUser()->getId()){
            $request->getSession()
                ->getFlashBag()
                ->add('error', "You don't have permission to handle this event")
            ;
            return $this->redirectToRoute('event_index');
        }

        $deleteForm = $this->createDeleteForm($event);
        $editForm = $this->createForm('Karhabty\EventsBundle\Form\EventType', $event);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_edit', array('id' => $event->getId()));
        }

        return $this->render('KarhabtyEventsBundle:event:edit.html.twig', array(
            'event' => $event,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a event entity.
     *
     */
    public function deleteAction(Request $request, Event $event)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user->getId() !== $event->getUser()->getId()){
            $request->getSession()
                ->getFlashBag()
                ->add('error', "You don't have permission to handle this event")
            ;
            return $this->redirectToRoute('event_index');
        }

        $form = $this->createDeleteForm($event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush($event);
        }
        $request->getSession()
            ->getFlashBag()
            ->add('success', "Your Event was successfully deleted ! ")
        ;

        return $this->redirectToRoute('event_index');
    }

    public function participateAction(Request $request, Event $event)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->get('security.token_storage')->getToken()->getUser();

        $eventService = $this->get('karhabty.event.service');
        $eventService->requestParticipation($user,$event);

        $request->getSession()
            ->getFlashBag()
            ->add('success', "Your participation request was successfully sent ! ")
        ;

        return $this->redirectToRoute('event_index');
    }

    public function acceptAction(Request $request, UserEventParticipation $participationRequest)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user->getId() !== $participationRequest->getEvent()->getUser()->getId()){
            $request->getSession()
                ->getFlashBag()
                ->add('error', "You don't have permission to handle this event")
            ;
            return $this->redirectToRoute('event_show',array('id'=>$participationRequest->getEvent()->getId()));
        }
        $eventService = $this->get('karhabty.event.service');
        $eventService->acceptParticipation($participationRequest) ;



        $request->getSession()
            ->getFlashBag()
            ->add('success', "this participation request to your event was successfully accepted ! ")
        ;
        $email = $participationRequest->getEvent()->getUser()->getEmail();
        $this->_sendMail($email);

        return $this->redirectToRoute('event_show',array('id'=>$participationRequest->getEvent()->getId()));

    }

    public function declineAction(Request $request, UserEventParticipation $participationRequest)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($user->getId() !== $participationRequest->getEvent()->getUser()->getId()){
            $request->getSession()
                ->getFlashBag()
                ->add('error', "You don't have permission to handle this event")
            ;
            return $this->redirectToRoute('event_show',array('id'=>$participationRequest->getEvent()->getId()));
        }
        $eventService = $this->get('karhabty.event.service');
        $eventService->declineParticipation($participationRequest) ;
        $request->getSession()
            ->getFlashBag()
            ->add('success', "this participation request to your event was successfully declined ! ")
        ;

        return $this->redirectToRoute('event_show',array('id'=>$participationRequest->getEvent()->getId()));

    }


    public function cancelAction(Request $request, Event $event)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $eventService = $this->get('karhabty.event.service');

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $participationRequest = $eventService->findParticipationRequestsBy(array('user'=>$user,'event'=>$event));

        if($user->getId() !== $participationRequest->getUser()->getId()){
            $request->getSession()
                ->getFlashBag()
                ->add('error', "You don't have permission to cancel this request")
            ;
            return $this->redirectToRoute('event_index');
        }
        $eventService->cancelParticipation($participationRequest) ;

        $request->getSession()
            ->getFlashBag()
            ->add('success', "Your participation to event was successfully canceled ! ")
        ;
        return $this->redirectToRoute('event_index');

    }


    /**
     * Creates a form to delete a event entity.
     *
     * @param Event $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Event $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('event_delete', array('id' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    private function _sendMail($data = array()) {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('send@example.com')
            ->setTo(array('mehdi.abidi@esprit.tn'))
            ->setBody(
                $this->renderView(
                    'KarhabtyEventsBundle:event:mail.html.twig',
                    array('data' => $data)
                ),
                'text/html'
            )
        ;
        $result = $this->get('mailer')->send($message);

    }
}
