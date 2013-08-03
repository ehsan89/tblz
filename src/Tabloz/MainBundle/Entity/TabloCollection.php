<?php

namespace Tabloz\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="tablo_collection")
 */
class TabloCollection
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="عنوان دسته بندی را وارد کنید.")
     */
    private $title;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $enable = true;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tabloz\UserBundle\Entity\User", inversedBy="tablo_collections")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="Tablo", mappedBy="collection")
     */
    protected $tablos;
    
    public function __construct()
    {
        // your own logic
    	$this->tablos = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return TabloCollection
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return TabloCollection
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     * @return TabloCollection
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean 
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set user
     *
     * @param \Tabloz\UserBundle\Entity\User $user
     * @return TabloCollection
     */
    public function setUser(\Tabloz\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Tabloz\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set image
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $image
     * @return TabloCollection
     */
    public function setImage(\Application\Sonata\MediaBundle\Entity\Media $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add tablos
     *
     * @param \Tabloz\MainBundle\Entity\Tablo $tablos
     * @return TabloCollection
     */
    public function addTablo(\Tabloz\MainBundle\Entity\Tablo $tablos)
    {
        $this->tablos[] = $tablos;

        return $this;
    }

    /**
     * Remove tablos
     *
     * @param \Tabloz\MainBundle\Entity\Tablo $tablos
     */
    public function removeTablo(\Tabloz\MainBundle\Entity\Tablo $tablos)
    {
        $this->tablos->removeElement($tablos);
    }

    /**
     * Get tablos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTablos()
    {
        return $this->tablos;
    }
}
