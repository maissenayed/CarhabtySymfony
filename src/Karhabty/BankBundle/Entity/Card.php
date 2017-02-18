<?php


namespace Karhabty\BankBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Karhabty\BankBundle\Repository\CardRepository")
 * @ORM\Table(name="card")
 */

class Card
{


    /**
     * @ORM\Id
     * @ORM\Column(name="id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    private $id;


    /**
     * @ORM\Column(type="string")
     */

    private $numCard;


    /**
     * @ORM\Column(type="string")
     */

    private $cvc;


    /**
     * @ORM\Column(type="string")
     */

    private $expdate;


    /**
     * @ORM\OneToOne(targetEntity="Karhabty\BankBundle\Entity\Account", cascade={"persist"})
     */
    private $account;



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
    public function getNumCard()
    {
        return $this->numCard;
    }

    /**
     * @param mixed $numCard
     */
    public function setNumCard($numCard)
    {
        $this->numCard = $numCard;
    }

    /**
     * @return mixed
     */
    public function getCvc()
    {
        return $this->cvc;
    }

    /**
     * @param mixed $cvc
     */
    public function setCvc($cvc)
    {
        $this->cvc = $cvc;
    }


    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param mixed $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }

    /**
     * @return mixed
     */
    public function getExpdate()
    {
        return $this->expdate;
    }

    /**
     * @param mixed $expdate
     */
    public function setExpdate($expdate)
    {
        $this->expdate = $expdate;
    }


}