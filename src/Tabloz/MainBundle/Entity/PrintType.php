<?php

namespace Tabloz\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="print_type")
 * @ORM\HasLifecycleCallbacks()
 */
class PrintType
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
     * @ORM\Column(type="string")
     */
    private $width;
    
    /**
     * @ORM\Column(type="string")
     */
    private $height;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="FrameType", inversedBy="print_types")
     * @ORM\JoinColumn(name="frame_type_id", nullable=false, referencedColumnName="id")
     */
    protected $frame;
    
    /**
     * @ORM\Column(type="string")
     */
    private $unit_price;
    
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
     * Returns the actual width of print according to the size given
     * @param int $width
     * @param int $height
     * @return int
     */
    public function getActualWidth($width, $height){
    	if ($this->width > $this->height){
    		if ($width > $height){
    			$w = $this->width;
    		} else {
    			$w = $this->width * ($height/$width);
    		}
    	} else {
    		if ($width > $height){
    			$w = $this->height;
    		} else {
    			$w = $this->height * ($width/$height);
    		}
    	}
    	return round($w);
    }

    /**
     * Returns the actual height of print according to the size given
     * @param int $width
     * @param int $height
     * @return int
     */
    public function getActualHeight($width, $height){
    	if ($this->width > $this->height){
    		if ($width > $height){
    			$h = $this->width * ($height/$width);
    		} else {
    			$h = $this->width;    			
    		}
    	} else {
    		if ($width > $height){
    			$h = $this->height * ($width/$height);
    		} else {
    			$h = $this->height;    			
    		}
    	}
    	return round($h);
    }
    
    /**
     * Renders the title width the appropriate size
     * @param int $width
     * @param int $height
     * @return string
     */
    public function getTitleBySize($width, $height){
    	$w = $this->getActualWidth($width, $height);
    	$h = $this->getActualHeight($width, $height);
    	return $this->getTitle().' ( '.$w.' × '.$h.' ) ';
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
     * @return PrintType
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
     * Set width
     *
     * @param string $width
     * @return PrintType
     */
    public function setWidth($width)
    {
        $this->width = $width;
    
        return $this;
    }

    /**
     * Get width
     *
     * @return string 
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set height
     *
     * @param string $height
     * @return PrintType
     */
    public function setHeight($height)
    {
        $this->height = $height;
    
        return $this;
    }

    /**
     * Get height
     *
     * @return string 
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return PrintType
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
     * Set unit_price
     *
     * @param string $unitPrice
     * @return PrintType
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unit_price = $unitPrice;
    
        return $this;
    }

    /**
     * Get unit_price
     *
     * @return string 
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     * @return PrintType
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
     * @return PrintType
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
     * @return PrintType
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
     * Set frame
     *
     * @param \Tabloz\MainBundle\Entity\FrameType $frame
     * @return PrintType
     */
    public function setFrame(\Tabloz\MainBundle\Entity\FrameType $frame)
    {
        $this->frame = $frame;
    
        return $this;
    }

    /**
     * Get frame
     *
     * @return \Tabloz\MainBundle\Entity\FrameType 
     */
    public function getFrame()
    {
        return $this->frame;
    }
}