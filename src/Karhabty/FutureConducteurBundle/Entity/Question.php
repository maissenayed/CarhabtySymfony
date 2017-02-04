<?php

namespace Karhabty\FutureConducteurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity(repositoryClass="Karhabty\FutureConducteurBundle\Repository\QuestionRepository")
 */
class Question
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
     * @ORM\Column(name="questionContent", type="string", length=255, nullable=true)
     */
    private $questionContent;

    /**
     * @var string
     *
     * @ORM\Column(name="imgUrl", type="string", length=255, nullable=true)
     */
    private $imgUrl;


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
     * Set questionContent
     *
     * @param string $questionContent
     *
     * @return Question
     */
    public function setQuestionContent($questionContent)
    {
        $this->questionContent = $questionContent;

        return $this;
    }

    /**
     * Get questionContent
     *
     * @return string
     */
    public function getQuestionContent()
    {
        return $this->questionContent;
    }

    /**
     * Set imgUrl
     *
     * @param string $imgUrl
     *
     * @return Question
     */
    public function setImgUrl($imgUrl)
    {
        $this->imgUrl = $imgUrl;

        return $this;
    }

    /**
     * Get imgUrl
     *
     * @return string
     */
    public function getImgUrl()
    {
        return $this->imgUrl;
    }
}

