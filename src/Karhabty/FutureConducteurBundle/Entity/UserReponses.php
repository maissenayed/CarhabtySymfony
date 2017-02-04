<?php

namespace Karhabty\FutureConducteurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserReponses
 *
 * @ORM\Table(name="user_reponses")
 * @ORM\Entity(repositoryClass="Karhabty\FutureConducteurBundle\Repository\UserReponsesRepository")
 */
class UserReponses
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
     * @var int
     *
     * @ORM\Column(name="test", type="integer", nullable=true)
     */
    private $test;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateTest", type="datetime", nullable=true)
     */
    private $dateTest;


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
     * @return UserReponses
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
     * @return UserReponses
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
     * Set test
     *
     * @param integer $test
     *
     * @return UserReponses
     */
    public function setTest($test)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test
     *
     * @return int
     */
    public function getTest()
    {
        return $this->test;
    }

    /**
     * Set dateTest
     *
     * @param \DateTime $dateTest
     *
     * @return UserReponses
     */
    public function setDateTest($dateTest)
    {
        $this->dateTest = $dateTest;

        return $this;
    }

    /**
     * Get dateTest
     *
     * @return \DateTime
     */
    public function getDateTest()
    {
        return $this->dateTest;
    }
}

