<?php

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Temas", mappedBy="TemasSecciones", cascade={"remove"})
     */

    private $SeccionesTemas;

    public function __construct()
    {
        $this->SeccionesTemas         = new ArrayCollection();

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
    //$this->SeccionesTemas         = new ArrayCollection();

    /**
     * Add SeccionesTemas
     *
     * @param \AppBundle\Entity\Secciones $SeccionesTemas
     *
     * @return Temas
     */
    public function addSeccionesTemas (\AppBundle\Entity\Secciones $SeccionesTemas)
    {
        $this->SeccionesTemas[] = $SeccionesTemas;
        return $this;
    }
    /**
     * Remove SeccionesTemas
     *
     * @param \AppBundle\Entity\Secciones $SeccionesTemas
     */
    public function removeSeccionesTemas(\AppBundle\Entity\Secciones $SeccionesTemas)
    {
        $this->SeccionesTemas->removeElement($SeccionesTemas);
    }
    /**
     * Get SeccionesTemas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSeccionesTemas()
    {
        return $this->SeccionesTemas;
    }
}
