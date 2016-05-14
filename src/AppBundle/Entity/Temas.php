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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Comentarios", inversedBy="ComentariosTemas")
     */

    private $TemasComentarios;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Secciones", inversedBy="SeccionesTemas")
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


    //$this->TemasComentarios = new ArrayCollection(); de muchos a 1 x2


    /**
     * Set TemasComentarios
     *
     * @param \Appbundle\Entity\Temas $TemasComentarios
     *
     * @return Comentarios
     */
    public function setTemasComentarios(\Appbundle\Entity\Temas $TemasComentarios = null)
    {
        $this->TemasComentarios = $TemasComentarios;
        return $this;
    }
    /**
     * Get TemasComentarios
     *
     * @return \Appbundle\Entity\Temas
     */
    public function getTemasComentarios()
    {
        return $this->TemasComentarios;
    }
    /**
     * añadir TemasComentarios
     *
     * @param \Appbundle\Entity\Temas $TemasComentarios
     *
     * @return Comentarios
     */
    public function añadirTemasComentariose(\Appbundle\Entity\Temas $TemasComentarios)
    {
        $this->TemasComentarios[] = $TemasComentarios;
        return $this;
    }
    /**
     * borrar TemasComentarios
     *
     * @param \Appbundle\Entity\Temas $TemasComentarios
     */
    public function borrarTemasComentarios(\Appbundle\Entity\Temas $TemasComentarios)
    {
        $this->TemasComentarios->removeElement($TemasComentarios);
    }

    //$this->TemasSecciones = new ArrayCollection();



    /**
     * Set TemasSecciones
     *
     * @param \Appbundle\Entity\Temas $TemasSecciones
     *
     * @return Secciones
     */
    public function setTemasSecciones(\Appbundle\Entity\Temas $TemasSecciones = null)
    {
        $this->TemasSecciones = $TemasSecciones;
        return $this;
    }
    /**
     * Get TemasSecciones
     *
     * @return \Appbundle\Entity\Temas
     */
    public function getTemasSecciones()
    {
        return $this->TemasSecciones;
    }
    /**
     * añadir TemasSecciones
     *
     * @param \Appbundle\Entity\Temas $TemasSecciones
     *
     * @return Secciones
     */
    public function añadirTemasSecciones(\Appbundle\Entity\Temas $TemasSecciones)
    {
        $this->TemasSecciones[] = $TemasSecciones;
        return $this;
    }
    /**
     * borrar TemasSecciones
     *
     * @param \Appbundle\Entity\Temas $TemasSecciones
     */
    public function borrarTemasSecciones(\Appbundle\Entity\Temas $TemasSecciones)
    {
        $this->TemasSecciones->removeElement($TemasSecciones);
    }










}
