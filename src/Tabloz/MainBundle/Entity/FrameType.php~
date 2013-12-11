<?php

namespace Tabloz\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="frame_type")
 * @ORM\HasLifecycleCallbacks()
 */
class FrameType
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     */
    private $title;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"remove"})
     */
    private $image;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $enable = true;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $created_at;
    
    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    private $updated_at;
    
    /**
     * @ORM\OneToMany(targetEntity="PrintType", mappedBy="frame", cascade={"remove"})
     */
    protected $print_types;


    public function __construct()
    {
        // your own logic
    }

    /**
     * {@inheritDoc}
     */
    public function __toString(){
    	return $this->getTitle();
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
     * @return FrameType
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
     * @return FrameType
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
     * @return FrameType
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return FrameType
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return FrameType
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set image
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $image
     * @return FrameType
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
     * Add print_types
     *
     * @param \Tabloz\MainBundle\Entity\PrintType $printTypes
     * @return FrameType
     */
    public function addPrintType(\Tabloz\MainBundle\Entity\PrintType $printTypes)
    {
        $this->print_types[] = $printTypes;
    
        return $this;
    }

    /**
     * Remove print_types
     *
     * @param \Tabloz\MainBundle\Entity\PrintType $printTypes
     */
    public function removePrintType(\Tabloz\MainBundle\Entity\PrintType $printTypes)
    {
        $this->print_types->removeElement($printTypes);
    }

    /**
     * Get print_types
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrintTypes()
    {
        return $this->print_types;
    }
}