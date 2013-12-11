<?php

namespace Application\ShoppingBundle\Entity\Tablo;

use Application\ShoppingBundle\Entity\Cart\CartItem;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="tablo_download_item")
 * @ORM\HasLifecycleCallbacks
 */
class TabloDownloadItem extends CartItem
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Application\ShoppingBundle\Entity\Cart\Cart
     */
    protected $cart;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tabloz\MainBundle\Entity\Tablo", inversedBy="tablo_download_items")
     * @ORM\JoinColumn(name="tablo_id", nullable=false, referencedColumnName="id")
     */
    protected $resource;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tabloz\MainBundle\Entity\DownloadType", inversedBy="tablo_download_items")
     * @ORM\JoinColumn(name="download_type_id", nullable=false, referencedColumnName="id")
     */
    protected $download_type;
    
    /**
     * @ORM\Column(type="string")
     */
    private $base_price = 0;

    public function __construct()
    {
    }
    
    /**
     * Checks whether the given object is equal to this object
     * @param $object
     * @return boolean
     */
    public function equals($object){
    	if ( $object instanceof TabloDownloadItem && $object->getResource()->getId() == $this->resource->getId() && $object->getDownloadType()->getId() == $this->download_type->getId() ){
    		return true;
    	}
    	return false;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function calculateTotal(){
        $this->setBasePrice($this->download_type->getUnitPrice());
        $this->setUnitPrice( ( ($this->resource->getDownloadMarkupPercent() + 100) * $this->getBasePrice() ) / 100 );
        $this->setTotal($this->getQuantity() * $this->getUnitPrice());
    }


    /**
     * Set base_price
     *
     * @param string $basePrice
     * @return TabloDownloadItem
     */
    public function setBasePrice($basePrice)
    {
        $this->base_price = $basePrice;
    
        return $this;
    }

    /**
     * Get base_price
     *
     * @return string 
     */
    public function getBasePrice()
    {
        return $this->base_price;
    }

    /**
     * Set resource
     *
     * @param \Tabloz\MainBundle\Entity\Tablo $resource
     * @return TabloDownloadItem
     */
    public function setResource(\Tabloz\MainBundle\Entity\Tablo $resource)
    {
        $this->resource = $resource;
    
        return $this;
    }

    /**
     * Get resource
     *
     * @return \Tabloz\MainBundle\Entity\Tablo 
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set download_type
     *
     * @param \Tabloz\MainBundle\Entity\DownloadType $downloadType
     * @return TabloDownloadItem
     */
    public function setDownloadType(\Tabloz\MainBundle\Entity\DownloadType $downloadType)
    {
        $this->download_type = $downloadType;
    
        return $this;
    }

    /**
     * Get download_type
     *
     * @return \Tabloz\MainBundle\Entity\DownloadType 
     */
    public function getDownloadType()
    {
        return $this->download_type;
    }
}