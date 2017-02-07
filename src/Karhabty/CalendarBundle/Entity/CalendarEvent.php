<?php

namespace Karhabty\CalendarBundle\Entity;

use AncaRebeca\FullCalendarBundle\Model\Event as BaseEvent;
use Doctrine\ORM\Mapping as ORM ; //doctrine : ORM
/**
 * @ORM\Entity
 */
class CalendarEvent
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(type="string",length=255)
     */

    protected $startDate;
    /**
     * @ORM\Column(type="string",length=255)
     */
    protected $title;
    /**
     * @ORM\Column(type="string",length=255)
     */
    protected $endDate;

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate( $startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate( $endDate)
    {
        $this->endDate = $endDate;
    }

    /**
     * @return mixed
     */
    public function getAllDay()
    {
        return $this->allDay;
    }

    /**
     * @param mixed $allDay
     */
    public function setAllDay($allDay)
    {
        $this->allDay = $allDay;
    }
    /**
     * @ORM\Column(type="string",length=255)
     */
    protected $allDay;
    /**
     * @ORM\ManyToOne(targetEntity="Voiture")
     * @ORM\JoinColumn(name="idVoiture",referencedColumnName="id",onDelete="CASCADE")
     */
    private $idVoiture;
























    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdVoiture()
    {
        return $this->idVoiture;
    }

    /**
     * @param mixed $idVoiture
     */
    public function setIdVoiture($idVoiture)
    {
        $this->idVoiture = $idVoiture;
    }

}