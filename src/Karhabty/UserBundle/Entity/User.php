<?php
// src/AppBundle/Entity/User.php

namespace Karhabty\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @ORM\Table(name="utilisateur")
 * @Vich\Uploadable
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */


    public $nom;

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param mixed $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */

    protected $prenom ;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */

    protected $telephone;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */

    protected $adresse;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */

    protected $nomsociete;



    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */

    protected $activite;

    /**
     * @return mixed
     */
    public function getActivite()
    {
        return $this->activite;
    }

    /**
     * @param mixed $activite
     */
    public function setActivite($activite)
    {
        $this->activite = $activite;
    }

    /**
     * @return mixed
     */
    public function getNomsociete()
    {
        return $this->nomsociete;
    }

    /**
     * @param mixed $nomsociete
     */
    public function setNomsociete($nomsociete)
    {
        $this->nomsociete = $nomsociete;
    }

    /**
     * @return mixed
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * @param mixed $siret
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
    }


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */

    protected $siret;




    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}