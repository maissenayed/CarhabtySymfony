<?php
/**
 * Created by PhpStorm.
 * User: Maissen
 * Date: 28/01/2017
 * Time: 09:26
 */
/**
 * Created by PhpStorm.
 * User: Maissen
 * Date: 05/01/2017
 * Time: 18:38
 */
namespace Karhabty\AnnonceBundle\Entity;
use Doctrine\ORM\Mapping as ORM ; //doctrine : ORM
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Annonce
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="date")
     */
    private $AnneeDeProduit;

    /**
     * @ORM\Column(type="date")
     */
    private $AnneePub;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Model;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Marque;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Region;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Ville;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Paye;
    /**
     * @ORM\Column(type="float",length=10)
     */
    private $Prix;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $Category;

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
    public function getAnneeDeProduit()
    {
        return $this->AnneeDeProduit;
    }

    /**
     * @param mixed $AnneeDeProduit
     */
    public function setAnneeDeProduit($AnneeDeProduit)
    {
        $this->AnneeDeProduit = $AnneeDeProduit;
    }

    /**
     * @return mixed
     */
    public function getAnneePub()
    {
        return $this->AnneePub;
    }

    /**
     * @param mixed $AnneePub
     */
    public function setAnneePub($AnneePub)
    {
        $this->AnneePub = $AnneePub;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->Model;
    }

    /**
     * @param mixed $Model
     */
    public function setModel($Model)
    {
        $this->Model = $Model;
    }

    /**
     * @return mixed
     */
    public function getMarque()
    {
        return $this->Marque;
    }

    /**
     * @param mixed $Marque
     */
    public function setMarque($Marque)
    {
        $this->Marque = $Marque;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->Region;
    }

    /**
     * @param mixed $Region
     */
    public function setRegion($Region)
    {
        $this->Region = $Region;
    }

    /**
     * @return mixed
     */
    public function getVille()
    {
        return $this->Ville;
    }

    /**
     * @param mixed $Ville
     */
    public function setVille($Ville)
    {
        $this->Ville = $Ville;
    }

    /**
     * @return mixed
     */
    public function getPaye()
    {
        return $this->Paye;
    }

    /**
     * @param mixed $Paye
     */
    public function setPaye($Paye)
    {
        $this->Paye = $Paye;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->Prix;
    }

    /**
     * @param mixed $Prix
     */
    public function setPrix($Prix)
    {
        $this->Prix = $Prix;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->Category;
    }

    /**
     * @param mixed $Category
     */
    public function setCategory($Category)
    {
        $this->Category = $Category;
    }
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="Annonce_image", fileNameProperty="imageName")
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
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return Annonce
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
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
     * @return Annonce
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
?>