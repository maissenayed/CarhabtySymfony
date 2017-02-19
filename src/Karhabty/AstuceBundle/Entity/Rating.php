<?php


namespace Karhabty\AstuceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Rating
 * @ORM\Entity
 */


class Rating
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id_rate;

    /**
     * Many Rates have One User.
     * @ORM\ManyToOne(targetEntity="Karhabty\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Many Rates have One Astuce.
     * @ORM\ManyToOne(targetEntity="Astuce")
     * @ORM\JoinColumn(name="astuce_id", referencedColumnName="id")
     */
    protected $id_astuce;

    /**
     * @ORM\Column(type="integer")
     *
     * @ORM\Column(name="value", type="text", length=65535, nullable=false)
     */
    protected $value;

    /**
     * @return mixed
     */
    public function getIdRate()
    {
        return $this->id_rate;
    }

    /**
     * @param mixed $id_rate
     */
    public function setIdRate($id_rate)
    {
        $this->id_rate = $id_rate;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getIdAstuce()
    {
        return $this->id_astuce;
    }

    /**
     * @param mixed $id_astuce
     */
    public function setIdAstuce($id_astuce)
    {
        $this->id_astuce = $id_astuce;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }



}