<?php


namespace Karhabty\AstuceBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Comment
 * @ORM\Entity
 */
class Comment
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

    private $commentaire;

    /**
     * Many Comments have One User.
     * @ORM\ManyToOne(targetEntity="Karhabty\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Many Comments have One Astuce.
     * @ORM\ManyToOne(targetEntity="Astuce",inversedBy="comments")
     * @ORM\JoinColumn(name="astuce_id", referencedColumnName="id")
     */
    private $astuce;

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
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param mixed $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
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
    public function getAstuce()
    {
        return $this->astuce;
    }

    /**
     * @param mixed $astuce
     */
    public function setAstuce($astuce)
    {
        $this->astuce = $astuce;
    }


}