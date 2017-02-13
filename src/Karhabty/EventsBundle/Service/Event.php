<?php
namespace Karhabty\EventsBundle\Service;

use Doctrine\ORM\EntityManager;
use Karhabty\EventsBundle\Entity\Event as EventEntity;
use Karhabty\EventsBundle\Entity\UserEventParticipation;
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 05/02/2017
 * Time: 10:54
 */
class Event
{
    /**
     *
     * @var EntityManager
     */
    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function find($eventId) {
        return $event = $this->em->getRepository('KarhabtyEventsBundle:Event')->find($eventId);
    }

    public function findAll() {
        return $events = $this->em->getRepository('KarhabtyEventsBundle:Event')->findAll();
    }


    public function findBy($criteria,$orderBy = null) {
        return $events = $this->em->getRepository('KarhabtyEventsBundle:Event')->findBy($criteria, $orderBy);
    }


    public function findFutureEvents() {
        return $events = $this->em
            ->createQuery('SELECT e FROM KarhabtyEventsBundle:Event e WHERE e.eventDate > CURRENT_DATE()')
            ->getResult();
    }

    public function findParticipationRequestsBy($criteria) {
        $participationRequests = $this->em->getRepository('KarhabtyEventsBundle:UserEventParticipation')->findBy($criteria);
        if(count($participationRequests) === 1 ){
            return reset($participationRequests);
        }elseif(empty($participationRequests)){
            return false;
        }
        return $participationRequests;
    }




    public function requestParticipation($userId,$eventId) {
        $participation = new UserEventParticipation();
        $participation->setUser($userId)
            ->setEvent($eventId)
            ->setStatus('request')
            ->setCreatedDate(new \DateTime())
        ;
        $this->save($participation);
    }

    public function acceptParticipation ($participationRequest) {
        $this->updateParticipation($participationRequest,'accepted');
    }

    public function cancelParticipation($participationRequest) {
        $this->updateParticipation($participationRequest,'canceled');
    }

    public function declineParticipation($participationRequest) {
        $this->updateParticipation($participationRequest,'declined');
    }

    public function updateParticipation(\Karhabty\EventsBundle\Entity\UserEventParticipation $participationRequest, $status) {
        $participationRequest->setStatus($status);
        $this->save($participationRequest);
    }


    public function save($entity) {
        $this->em->persist($entity);
        $this->em->flush();
    }

}