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
     * @ORM\ManyToOne(targetEntity="Trascastro\UserBundle\Entity\User", inversedBy="UserTemas", cascade={"remove"})
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
     * @return mixed
     */
    public function getTemasUser()
    {
        return $this->TemasUser;
    }

    /**
     * @param mixed $TemasUser
     */
    public function setTemasUser($TemasUser)
    {
        $this->TemasUser = $TemasUser;
    }



    //$this->TemasComentarios = new ArrayCollection(); de 1 a muchos


    /**
     * Add TemasComentarios
     *
     * @param \AppBundle\Entity\Temas $TemasComentarios
     *
     * @return Comentarios
     */
    public function addTemasComentarios(\AppBundle\Entity\Temas $TemasComentarios)
    {
        $this->TemasComentarios[] = $TemasComentarios;
        return $this;
    }
    /**
     * Remove TemasComentarios
     *
     * @param \AppBundle\Entity\Temas $TemasComentarios
     */
    public function removeTemasComentarios(\AppBundle\Entity\Temas $TemasComentarios)
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
     * @param \AppBundle\Entity\Temas $TemasSecciones
     *
     * @return Secciones
     */
    public function addTemasSecciones(\AppBundle\Entity\Temas $TemasSecciones)
    {
        $this->TemasSecciones[] = $TemasSecciones;
        return $this;
    }
    /**
     * Remove TemasSecciones
     *
     * @param \AppBundle\Entity\Temas $TemasSecciones
     */
    public function removeTemasSecciones(\AppBundle\Entity\Temas $TemasSecciones)
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










    /**
     * Add temasComentario
     *
     * @param \AppBundle\Entity\Comentarios $temasComentario
     *
     * @return Temas
     */
    public function addTemasComentario(\AppBundle\Entity\Comentarios $temasComentario)
    {
        $this->TemasComentarios[] = $temasComentario;

        return $this;
    }

    /**
     * Remove temasComentario
     *
     * @param \AppBundle\Entity\Comentarios $temasComentario
     */
    public function removeTemasComentario(\AppBundle\Entity\Comentarios $temasComentario)
    {
        $this->TemasComentarios->removeElement($temasComentario);
    }

    /**
     * Add temasSeccione
     *
     * @param \AppBundle\Entity\Secciones $temasSeccione
     *
     * @return Temas
     */
    public function addTemasSeccione(\AppBundle\Entity\Secciones $temasSeccione)
    {
        $this->TemasSecciones[] = $temasSeccione;

        return $this;
    }

    /**
     * Remove temasSeccione
     *
     * @param \AppBundle\Entity\Secciones $temasSeccione
     */
    public function removeTemasSeccione(\AppBundle\Entity\Secciones $temasSeccione)
    {
        $this->TemasSecciones->removeElement($temasSeccione);
    }
}
