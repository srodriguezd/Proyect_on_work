<?php
/**
 * (c) Ismael Trascastro <i.trascastro@gmail.com>
 *
 * @link        http://www.ismaeltrascastro.com
 * @copyright   Copyright (c) Ismael Trascastro. (http://www.ismaeltrascastro.com)
 * @license     MIT License - http://en.wikipedia.org/wiki/MIT_License
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Trascastro\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="app_user")
 * @ORM\Entity(repositoryClass="Trascastro\UserBundle\Repository\UserRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Image", inversedBy="ImgUser")
     *

    private $UserImg;*/

    /**
    * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comentarios", mappedBy="ComentariosUser")
     * @ORM\Column(name="usercomentarios")
     */
    private $UserComentarios;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Temas", mappedBy="TemasUser")
     */

    private $UserTemas;


    public function __construct()
    {
        $this->UserTemas = new ArrayCollection();

        $this->UserComentarios = new ArrayCollection();

        parent::__construct();

        $this->createdAt    = new \DateTime();
        $this->updatedAt    = $this->createdAt;



    }

    public function setCreatedAt()
    {
        // never used
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
     * @ORM\PreUpdate()
     *
     * @return User
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
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

    public function __toString()
    {
        return $this->username;
    }

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



    //TEMAS, COMENTARIOS>STR   ,   IMAG>DEB $this->UserComentarios = new ArrayCollection();

    /**
     * Add UserComentarios
     *
     * @param \Trascastro\UserBundle\Entity\User $UserComentarios
     *
     * @return Comentarios
     */
    public function addUserComentarios(\Appbundle\Entity\Comentarios $UserComentarios)
    {
        $this->UserComentarios[] = $UserComentarios;
        return $this;
    }
    /**
     * Remove UserComentarios
     *
     * @param \Trascastro\UserBundle\Entity\User $UserComentarios
     */
    public function removeUserComentarios(\Trascastro\UserBundle\Entity\User $UserComentarios)
    {
        $this->UserComentarios->removeElement($UserComentarios);
    }
    /**
     * Get UserComentarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserComentarios()
    {
        return $this->UserComentarios;
    }



    /**
     * Set UserTemas
     *
     * @param \Trascastro\UserBundle\Entity\User $UserTemas
     *
     * @return Temas
     */
    public function setUserTemas(\Trascastro\UserBundle\Entity\User $UserTemas = null)
    {
        $this->UserTemas = $UserTemas;
        return $this;
    }
    /**
     * Get UserTemas
     *
     * @return \Trascastro\UserBundle\Entity\User
     */
    public function getUserTemas()
    {
        return $this->UserTemas;
    }
    /**
     * añadir UserTemas
     *
     * @param \Trascastro\UserBundle\Entity\User $UserTemas
     *
     * @return Temas
     */
    public function añadirUserTemas(\Trascastro\UserBundle\Entity\User $UserTemas)
    {
        $this->UserTemas[] = $UserTemas;
        return $this;
    }
    /**
     * borrar UserTemas
     *
     * @param \Trascastro\UserBundle\Entity\User $UserTemas
     */
    public function borrarUserTemas(\Trascastro\UserBundle\Entity\User $UserTemas)
    {
        $this->UserTemas->removeElement($UserTemas);
    }







    /**
     * Set image
     *
     * @param \Trascastro\UserBundle\Entity\Image $image
     *
     * @return User
     *
    public function setImage(\AppBundle\Entity\Image  $user = null)
    {
        $this->image= $image;
        return $this;
    }
    /**
     * Get image
     *
     * @return \AppBundle\Entity\Image
     *
    public function getImage()
    {
        return $this->image;
    }

     * Queda pendiente de hacer
     *
    */

















}