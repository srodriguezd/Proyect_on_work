<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Comentarios
 *
 * @ORM\Table(name="comentarios")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ComentariosRepository")
 */
class Comentarios
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
     * @ORM\Column(name="comentario", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="upated_at", type="datetime")
     */
    private $updatedAt;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Temas", mappedBy="TemasComentarios", cascade={"remove"})
     */

    private $ComentariosTemas;

    /**
     * @ORM\OneToMany(targetEntity="Trascastro\UserBundle\Entity\User", mappedBy="UserComentarios", cascade={"remove"})
     */

    private $ComentariosUser;


    public function __construct()
    {
        $this->ComentariosTemas = new ArrayCollection();

        $this->ComentariosUser= new ArrayCollection();


        $this->createdAt    = new \DateTime();
        $this->updatedAt    = $this->createdAt;

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
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

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
    // $this->ComentariosTemas = new ArrayCollection();
    //$this->ComentariosUser= new ArrayCollection();
    /**
     * Add ComentariosTemas
     *
     * @param \AppBundle\Entity\Comentarios $ComentariosTemas
     *
     * @return Temas
     */
    public function addComentariosTemas(\AppBundle\Entity\Comentarios $ComentariosTemas)
    {
        $this->ComentariosTemas[] = $ComentariosTemas;
        return $this;
    }
    /**
     * Remove ComentariosTemas
     *
     * @param \AppBundle\Entity\Comentarios $ComentariosTemas
     */
    public function removeComentariosTemas(\AppBundle\Entity\Comentarios $ComentariosTemas)
    {
        $this->ComentariosTemas->removeElement($ComentariosTemas);
    }
    /**
     * Get ComentariosTemas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComentariosTemas()
    {
        return $this->ComentariosTemas;
    }





    /**
     * Add ComentariosUser
     *
     * @param \AppBundle\Entity\Comentarios  $ComentariosUser
     *
     * @return User
     */
    public function addComentariosUser(\AppBundle\Entity\Comentarios $ComentariosUser)
    {
        $this->ComentariosUser[] = $ComentariosUser;
        return $this;
    }
    /**
     * Remove ComentariosUser
     *
     * @param \AppBundle\Entity\Comentarios  $ComentariosUser
     */
    public function removeComentariosUser(\AppBundle\Entity\Comentarios  $ComentariosUser)
    {
        $this->ComentariosUser->removeElement($ComentariosUser);
    }
    /**
     * Get ComentariosUser
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComentariosUser()
    {
        return $this->ComentariosUser;
    }
}