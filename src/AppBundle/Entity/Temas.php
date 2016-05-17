<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Temas
 *
 * @ORM\Table(name="temas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TemasRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Temas
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
     * @ORM\Column(name="nombreTema", type="string", length=50)
     */
    private $nombreTema;

    /**
     * @var string
     *
     * @ORM\Column(name="textoTema", type="string", length=2000)
     */
    private $textoTema;


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
     * @ORM\OneToMany(targetEntity="Trascastro\UserBundle\Entity\User", mappedBy="UserTemas", cascade={"remove"})
     */

    private $TemasUser;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comentarios", mappedBy="ComentariosTemas")
     */

    private $TemasComentarios;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Secciones", mappedBy="SeccionesTemas")
     */

    private $TemasSecciones;


    public function __construct()
    {
        $this->TemasUser = new ArrayCollection();
        $this->TemasComentarios = new ArrayCollection();
        $this->TemasSecciones = new ArrayCollection();


        $this->createdAt    = new \DateTime();
        $this->updatedAt    = $this->createdAt;



    }


    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue() {
        $this->setUpdatedAt(new \DateTime());
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
     * Set nombreTema
     *
     * @param string $nombreTema
     *
     * @return Temas
     */
    public function setNombreTema($nombreTema)
    {
        $this->nombreTema = $nombreTema;

        return $this;
    }

    /**
     * Get nombreTema
     *
     * @return string
     */
    public function getNombreTema()
    {
        return $this->nombreTema;
    }

    /**
     * Set textoTema
     *
     * @param string $textoTema
     *
     * @return Temas
     */
    public function setTextoTema($textoTema)
    {
        $this->textoTema = $textoTema;

        return $this;
    }

    /**
     * Get textoTema
     *
     * @return string
     */
    public function getTextoTema()
    {
        return $this->textoTema;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Temas
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
     * @return Temas
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


    ///AQUI VA LO NUEVO, COMENTARIOS SECCIONES Y USER
    //$this->TemasUser = new ArrayCollection(); uno a muchos

    /**
     * Add TemasUser
     *
     * @param \AppBundle\Entity\Temas $TemasUser
     *
     * @return User
     */
    public function addTemasUser(\AppBundle\Entity\Temas $TemasUser)
    {
        $this->TemasUser[] = $TemasUser;
        return $this;
    }
    /**
     * Remove TemasUser
     *
     * @param \AppBundle\Entity\Temas $TemasUser
     */
    public function removeTemasUser(\AppBundle\Entity\Temas $TemasUser)
    {
        $this->TemasUser->removeElement($TemasUser);
    }
    /**
     * Get TemasUser
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTemasUser()
    {
        return $this->TemasUser;
    }


    //$this->TemasComentarios = new ArrayCollection(); de 1 a muchos


    /**
     * Add TemasComentarios
     *
     * @param \AppBundle\Entity\TemasComentarios $TemasComentarios
     *
     * @return Comentarios
     */
    public function addTemasComentarios(\AppBundle\Entity\TemasComentarios $TemasComentarios)
    {
        $this->TemasComentarios[] = $TemasComentarios;
        return $this;
    }
    /**
     * Remove TemasComentarios
     *
     * @param \AppBundle\Entity\TemasComentarios $TemasComentarios
     */
    public function removeTemasComentarios(\AppBundle\Entity\TemasComentarios $TemasComentarios)
    {
        $this->TemasComentarios->removeElement($TemasComentarios);
    }
    /**
     * Get TemasComentarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTemasComentarios()
    {
        return $this->TemasComentarios;
    }

    //$this->TemasSecciones = new ArrayCollection();

    /**
     * Add TemasSecciones
     *
     * @param \AppBundle\Entity\TemasSecciones $TemasSecciones
     *
     * @return Secciones
     */
    public function addTemasSecciones(\AppBundle\Entity\TemasSecciones $TemasSecciones)
    {
        $this->TemasSecciones[] = $TemasSecciones;
        return $this;
    }
    /**
     * Remove TemasSecciones
     *
     * @param \AppBundle\Entity\TemasSecciones $TemasSecciones
     */
    public function removeTemasSecciones(\AppBundle\Entity\TemasSecciones $TemasSecciones)
    {
        $this->TemasSecciones->removeElement($TemasSecciones);
    }
    /**
     * Get TemasSecciones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTemasSecciones()
    {
        return $this->TemasSecciones;
    }









}
