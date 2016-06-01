<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Comentarios
 *
 * @ORM\Table(name="comentarios")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ComentariosRepository")
 */
class Comentarios
{

    const PAGINATION_ITEMS = 4;

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
     * @ORM\Column(name="comentario", type="string", length=800, nullable=true)
     */
    private $comentario;


     /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Temas", inversedBy="TemasComentarios")
     */

    private $ComentariosTemas;

    /**
     * @ORM\ManyToOne(targetEntity="Trascastro\UserBundle\Entity\User", inversedBy="UserComentarios")
     *
     * @ORM\Column(name="comentariosuser", length=255, nullable=true)
     */

    private $ComentariosUser;


    public function __construct()
    {
        $this->createdAt  = new \DateTime();
        $this->updatedAt  = new \DateTime("now");

    }

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
     * Set comentario
     *
     * @param string $comentario
     *
     * @return Comentarios
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue() {
        $this->setUpdatedAt(new \DateTime());
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Comentarios
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Comentarios
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \Datetime("now");
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    //AQUI VA LO NUEVO, RELACIONES CON TEMAS Y USER shit3fr
    // $this->ComentariosTemas = new ArrayCollection(); many to one
    //$this->ComentariosUser= new ArrayCollection();
    /**
     * Set ComentariosTemas
     *
     * @param \Appbundle\Entity\Comentarios $ComentariosTemas
     *
     * @return Temas
     */
    public function setComentariosTemas(\Appbundle\Entity\Temas $ComentariosTemas = null)
    {
        $this->ComentariosTemas = $ComentariosTemas;
        return $this;
    }
    /**
     * Get ComentariosTemas
     *
     * @return \Appbundle\Entity\Comentarios
     */
    public function getComentariosTemas()
    {
        return $this->ComentariosTemas;
    }
    /**
     * añadir ComentariosTemas
     *
     * @param \Appbundle\Entity\Comentarios $ComentariosTemas
     *
     * @return Temas
     */
    public function añadirComentariosTemas(\Appbundle\Entity\Comentarios $ComentariosTemas)
    {
        $this->ComentariosTemas[] = $ComentariosTemas;
        return $this;
    }
    /**
     * borrar ComentariosTemas
     *
     * @param \Appbundle\Entity\Comentarios $ComentariosTemas
     */
    public function borrarComentariosTemas(\Appbundle\Entity\Comentarios $ComentariosTemas)
    {
        $this->ComentariosTemas->removeElement($ComentariosTemas);
    }


    //private $ComentariosUser;

    /**
     * Set ComentariosUser
     *
     * @param \Appbundle\Entity\Comentarios $ComentariosUser
     *
     * @return User
     */
    public function setComentariosUser(\Trascastro\UserBundle\Entity\User $ComentariosUser = null)
    {
        $this->ComentariosUser = $ComentariosUser;
        return $this;
    }
    /**
     * Get ComentariosUser
     *
     * @return \Appbundle\Entity\Comentarios
     */
    public function getComentariosUser()
    {
        return $this->ComentariosUser;
    }

    /**
     * añadir ComentariosUser
     *
     * @param \Appbundle\Entity\Comentarios $ComentariosUser
     *
     * @return User
     */
    public function añadirComentariosUser(\Trascastro\UserBundle\Entity\User $ComentariosUser = null)
    {
        $this->ComentariosUser = $ComentariosUser;
        return $this;
    }
    /**
     * borrar ComentariosUser
     *
     * @param \Appbundle\Entity\Comentarios $ComentariosUser
     */
    public function borrarComentariosUser(\Appbundle\Entity\Comentarios $ComentariosUser)
    {
        $this->ComentariosTemas->removeElement($ComentariosUser);
    }
}
