<?php

namespace Tabloz\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="tablo_category")
 */
class TabloCategory
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
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="توصیفگر دسته بندی را وارد کنید.")
     */
    private $descriptor;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $enable = true;

    /**
     * @ORM\OneToMany(targetEntity="Tablo", mappedBy="category")
     */
    protected $tablos;
    
    public function __construct()
    {
        // your own logic
    	$this->tablos = new ArrayCollection();
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(){
    	return $this->title.'';
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
     * @return TabloCategory
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
     * Set descriptor
     *
     * @param string $descriptor
     * @return TabloCategory
     */
    public function setDescriptor($descriptor)
    {
        $this->descriptor = $descriptor;
    
        return $this;
    }

    /**
     * Get descriptor
     *
     * @return string 
     */
    public function getDescriptor()
    {
        return $this->descriptor;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return TabloCategory
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
     * @return TabloCategory
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
     * Add tablos
     *
     * @param \Tabloz\MainBundle\Entity\Tablo $tablos
     * @return TabloCategory
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
