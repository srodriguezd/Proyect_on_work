<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Secciones
 *
 * @ORM\Table(name="secciones")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SeccionesRepository")
 */
class Secciones
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
     * @ORM\Column(name="nombreSeccion", type="string", length=20, unique=true)
     */
    private $nombreSeccion;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Temas", inversedBy="TemasSecciones", cascade={"remove"})
     */

    private $SeccionesTemas;

    public function __construct()
    {

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
     * Set nombreSeccion
     *
     * @param string $nombreSeccion
     *
     * @return Secciones
     */
    public function setNombreSeccion($nombreSeccion)
    {
        $this->nombreSeccion = $nombreSeccion;

        return $this;
    }

    /**
     * Get nombreSeccion
     *
     * @return string
     */
    public function getNombreSeccion()
    {
        return $this->nombreSeccion;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Secciones
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
     * @return Secciones
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


    //AQUI VA LO NUEVO, RELACIONES CON TEMAS shit3fr
    //$this->SeccionesTemas         = new ArrayCollection(); de muchos a 1

    /**
     * Set SeccionesTemas
     *
     * @param \Appbundle\Entity\Secciones  $SeccionesTemas
     *
     * @return Temas
     */
    public function setSeccionesTemas (\Appbundle\Entity\Secciones $SeccionesTemas  = null)
    {
        $this->SeccionesTemas  = $SeccionesTemas ;
        return $this;
    }
    /**
     * Get SeccionesTemas
     *
     * @return \Appbundle\Entity\Secciones
     */
    public function getSeccionesTemas ()
    {
        return $this->SeccionesTemas ;
    }
    /**
     * añadir SeccionesTemas
     *
     * @param \Appbundle\Entity\Secciones  $SeccionesTemas
     *
     * @return Temas
     */
    public function añadirSeccionesTemas (\Appbundle\Entity\Secciones  $SeccionesTemas )
    {
        $this->SeccionesTemas [] = $SeccionesTemas ;
        return $this;
    }
    /**
     * borrar SeccionesTemas
     *
     * @param \Appbundle\Entity\Secciones  $SeccionesTemas
     */
    public function borrarSeccionesTemas (\Appbundle\Entity\Secciones  $SeccionesTemas )
    {
        $this->SeccionesTemas->removeElement($SeccionesTemas);
    }
}
