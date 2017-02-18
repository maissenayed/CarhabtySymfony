<?php
/**
 * Created by PhpStorm.
 * User: GARCII
 * Date: 2/12/2017
 * Time: 2:58 PM
 */

namespace Karhabty\OffreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Karhabty\OffreBundle\Repository\CouponRepository")
 * @ORM\Table(name="coupon")
 */
class Coupon
{


    public function __construct()
    {
        $this->date = new \DateTimeImmutable();
    }


    /**
     * @ORM\Id
     * @ORM\Column(name="id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */


    private $idCoupon;



    /**
     * @ORM\ManyToOne(targetEntity="Karhabty\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idUser", referencedColumnName="id")
     */


    private $user;



    /**
     * @ORM\ManyToOne(targetEntity="Karhabty\OffreBundle\Entity\Offre")
     * @ORM\JoinColumn(name="idOffre", referencedColumnName="id",onDelete="CASCADE")
     */

    private $offre;


    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */


    private $date;


    /**
     * @ORM\Column(type="string")
     */

    private $reference;

    /**
     * @return mixed
     */
    public function getIdCoupon()
    {
        return $this->idCoupon;
    }

    /**
     * @param mixed $idCoupon
     */
    public function setIdCoupon($idCoupon)
    {
        $this->idCoupon = $idCoupon;
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
    public function getOffre()
    {
        return $this->offre;
    }

    /**
     * @param mixed $offre
     */
    public function setOffre($offre)
    {
        $this->offre = $offre;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param mixed $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }


}