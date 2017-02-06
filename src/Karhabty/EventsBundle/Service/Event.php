<?php
namespace Karhabty\EventsBundle\Service;

use Doctrine\ORM\EntityManager;
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
        return $events = $this->em->getRepository('KarhabtyEventsBundle:Event')->find($eventId);
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




    public function requestParticipation() {

    }

    public function acceptParticipation () {

    }

    public function cancelParticipation() {

    }

    public function declineParticipation() {

    }

    public function updateParticipation(\Karhabty\EventsBundle\Entity\Event $event, $userId, $status) {


    }

}