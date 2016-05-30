<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Temas
 *
 * @ORM\Table(name="temas")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TemasRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
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
     * @ORM\ManyToOne(targetEntity="Trascastro\UserBundle\Entity\User", inversedBy="UserTemas")
     */

    private $TemasUser;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comentarios", mappedBy="ComentariosTemas", cascade={"persist"})
     */

    private $TemasComentarios;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Secciones", mappedBy="SeccionesTemas")
     */

    private $TemasSecciones;

    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="image_upload", fileNameProperty="imageName")
     *
     * @var File
     */
    private $prodFile;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     *
     */
    private $imageName;


    public function __construct()
    {
        $this->TemasComentarios = new ArrayCollection();
        $this->TemasSecciones = new ArrayCollection();

        $this->createdAt  = new \DateTime();
        $this->updatedAt  = new \DateTime("now");




    }


    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the  update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     *
     * @return  Temas
     */
    public function setprodFile(File $image = null)
    {
        $this->prodFile = $image;
        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }
    /**
     * @return File
     */
    public function getProdFile()
    {
        return $this->prodFile;
    }
    /**
     * @param string $imageName
     *
     * @return Temas
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;
        return $this;
    }
    /**
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
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
