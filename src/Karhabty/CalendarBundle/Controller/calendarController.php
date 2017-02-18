<?php

namespace Karhabty\CalendarBundle\Controller;

use Karhabty\CalendarBundle\Entity\Voiture;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Karhabty\CalendarBundle\Entity\CalendarEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class calendarController extends Controller
{
    public function indexAction(Voiture $id)
    {
        return $this->render('@KarhabtyCalendar/calendar.html.twig', array(
            'voiture' => $id));
    }
    public function loadAction(Request $request){
        if ($request->isXmlHttpRequest()) {

            $type = $request->request->get('type');


            if($type == 'new')
            {   $em = $this->getDoctrine()->getManager();
                $id= $request->request->get('id');
                $voiture= $em->getRepository("KarhabtyCalendarBundle:Voiture")->find($id);

                $startdate = $request->request->get('startdate').'+'.$request->request->get('zone');
                $title = $request->request->get('title');
                $calander =new CalendarEvent();
                $calander->setStartDate($startdate);
                $calander->setTitle($title);
                $calander->setEndDate($startdate);
                $calander->setAllDay("false");
                $calander->setIdVoiture($voiture);
                $em->persist($calander);
                $em->flush();
                return new JsonResponse(array('status'=>'success','eventid'=>$calander->getId()));

            }





            if($type == 'changetitle')
            {
                $eventid = $request->request->get('eventid');
                $title = $request->request->get('title');
                $em = $this->getDoctrine()->getManager();
                $calander= $em->getRepository("KarhabtyCalendarBundle:CalendarEvent")->find($eventid);
                $calander->setTitle($title);
                $em->persist($calander);
                $em->flush();

                return new JsonResponse(array('status'=>'success'));


            }

            if($type == 'resetdate')
            {
                $title = $request->request->get('title');
                $startdate =$request->request->get('start');
                $enddate =$request->request->get('end');
                $eventid =$request->request->get('eventid');
                $em = $this->getDoctrine()->getManager();
                $calander= $em->getRepository("KarhabtyCalendarBundle:CalendarEvent")->find($eventid);
                $calander->setTitle($title);
                $calander->setStartDate($startdate);
                $calander->setEndDate($enddate);
                $em->persist($calander);
                $em->flush();
                return new JsonResponse(array('status'=>'success'));
            }

            if($type == 'remove')
            {
                $eventid =$request->request->get('eventid');
                $em = $this->getDoctrine()->getManager();
                $calander= $em->getRepository("KarhabtyCalendarBundle:CalendarEvent")->find($eventid);
                $em->remove($calander);
                $em->flush();
                return new JsonResponse(array('status'=>'success'));
            }




            if($type == 'fetch')
            {   $em = $this->getDoctrine()->getManager();
                $calander= $em->getRepository("KarhabtyCalendarBundle:CalendarEvent")->findAll();
                $events = array();

                foreach($calander as $row){
                    $e = array();
                    $e['id'] = $row->getId();
                    $e['title'] = $row->getTitle();
                    $e['start'] = $row->getStartDate();
                    $e['end'] = $row->getEndDate();
                    $e["allDay"] = $row->getAllDay() ;
                    array_push($events, $e);
                }
                return new JsonResponse($events);

            }
            return new Response("dude");
        }
        return new Response('This is not ajax!', 400);



    }

}
