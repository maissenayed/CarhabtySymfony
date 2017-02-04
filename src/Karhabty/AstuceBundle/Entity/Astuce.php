<?php


namespace Karhabty\AstuceBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;



/**
 * @ORM\Entity
 *
 */

class Astuce
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */

    private  $id;

    /**
     * @ORM\Column(type="string",length=255)
     */

    private $theme;

    /**
     * @ORM\Column(type="string",length=255)
     */

    private $titre;

    /**
     * @ORM\Column(type="string",length=255)
     */

    private $description;


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
    public function getTheme()
    {
        return $this->theme;
    }

    /**
     * @param mixed $theme
     */
    public function setTheme($theme)
    {
        $this->theme = $theme;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }




}