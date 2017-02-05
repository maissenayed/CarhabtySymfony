<?php

namespace Karhabty\FutureConducteurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reponse
 *
 * @ORM\Table(name="reponse")
 * @ORM\Entity(repositoryClass="Karhabty\FutureConducteurBundle\Repository\ReponseRepository")
 */
class Reponse
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="reponseContent", type="string", length=255, nullable=true)
     */
    private $reponseContent;

    /**
     * @var bool
     *
     * @ORM\Column(name="ok", type="boolean", nullable=true)
     */
    private $ok;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reponseContent
     *
     * @param string $reponseContent
     *
     * @return Reponse
     */
    public function setReponseContent($reponseContent)
    {
        $this->reponseContent = $reponseContent;

        return $this;
    }

    /**
     * Get reponseContent
     *
     * @return string
     */
    public function getReponseContent()
    {
        return $this->reponseContent;
    }

    /**
     * Set ok
     *
     * @param boolean $ok
     *
     * @return Reponse
     */
    public function setOk($ok)
    {
        $this->ok = $ok;

        return $this;
    }

    /**
     * Get ok
     *
     * @return bool
     */
    public function getOk()
    {
        return $this->ok;
    }



    /**
     * Many Features have One Product.
     * @ORM\ManyToOne(targetEntity="Question", inversedBy="Reponse")
     * @ORM\JoinColumn(name="quest_id", referencedColumnName="id")
     */
    private $question;


    public function getQuestion()
    {return $this->question;}

    public function setQuestion($var)
    {$this->question=$var;}
}

