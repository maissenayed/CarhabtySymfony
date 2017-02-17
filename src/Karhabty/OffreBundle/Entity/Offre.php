<?php

namespace Karhabty\OffreBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Karhabty\UserBundle\Entity;

/**
 * @ORM\Entity(repositoryClass="Karhabty\OffreBundle\Repository\OffreRepository")
 * @ORM\Table(name="offre")
 * @Vich\Uploadable
 */

class Offre
{



    /**
     * @ORM\Id
     * @ORM\Column(name="id",type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */


    private $idOffre;



    /**
     * @ORM\Column(type="string")
     */


    private $nomOffre;




    /**
     * @ORM\Column(type="string")
     */


    private $descriptionOffre;



    /**
     * @ORM\Column(type="integer")
     */


    private $prix;



    /**
     * @ORM\Column(type="integer")
     */


    private $tauxReduction;

    /**
     * @return mixed
     */
    public function getIdOffre()
    {
        return $this->idOffre;
    }

    /**
     * @param mixed $idOffre
     */
    public function setIdOffre($idOffre)
    {
        $this->idOffre = $idOffre;
    }

    /**
     * @return mixed
     */
    public function getNomOffre()
    {
        return $this->nomOffre;
    }

    /**
     * @param mixed $nomOffre
     */
    public function setNomOffre($nomOffre)
    {
        $this->nomOffre = $nomOffre;
    }

    /**
     * @return mixed
     */
    public function getDescriptionOffre()
    {
        return $this->descriptionOffre;
    }

    /**
     * @param mixed $descriptionOffre
     */
    public function setDescriptionOffre($descriptionOffre)
    {
        $this->descriptionOffre = $descriptionOffre;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getTauxReduction()
    {
        return $this->tauxReduction;
    }

    /**
     * @param mixed $tauxReduction
     */
    public function setTauxReduction($tauxReduction)
    {
        $this->tauxReduction = $tauxReduction;
    }




    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $date;




    public function __construct()
    {
        $this->date = new \DateTimeImmutable();
    }
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="offres_image", fileNameProperty="imageName")
     *
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;



    /**
     * @return mixed
     */
    public function getDateExpirationOffre()
    {
        return $this->DateExpirationOffre;
    }

    /**
     * @param mixed $DateExpirationOffre
     */
    public function setDateExpirationOffre($DateExpirationOffre)
    {
        $this->DateExpirationOffre = $DateExpirationOffre;
    }

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return offre
     */




    /**
     * @ORM\Column(type="date")
     */


    private $DateExpirationOffre;



    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;


    }

    /**
     * @return File|null
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * @param string $imageName
     *
     * @return offre
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName()
    {
        return $this->imageName;
    }


    /**
     * @ORM\ManyToOne(targetEntity="Karhabty\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="idUser", referencedColumnName="id",onDelete="CASCADE")
     */

    private $user;

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




}