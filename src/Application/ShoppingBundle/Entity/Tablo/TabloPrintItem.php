<?php

namespace Application\ShoppingBundle\Entity\Tablo;

use Application\ShoppingBundle\Entity\Cart\CartItem;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="tablo_print_item")
 * @ORM\HasLifecycleCallbacks
 */
class TabloPrintItem extends CartItem
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
     * @ORM\ManyToOne(targetEntity="Tabloz\MainBundle\Entity\Tablo", inversedBy="tablo_print_items")
     * @ORM\JoinColumn(name="tablo_id", nullable=false, referencedColumnName="id")
     */
    protected $resource;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tabloz\MainBundle\Entity\PrintType", inversedBy="tablo_print_items")
     * @ORM\JoinColumn(name="print_type_id", nullable=false, referencedColumnName="id")
     */
    protected $print_type;
    
    /**
     * @ORM\Column(type="string")
     */
    private $base_price = 0;

    public function __construct(){
    	
    }
	
	/**
	 * Returns the view of the item in the cart (object parameter will be passed to this template)
	 */
	public function getCartView(){
		return 'ApplicationShoppingBundle:Tablo:tablo_print_item_view.html.twig';
	}
    
    /**
     * Checks whether the given object is equal to this object
     * @param $object
     * @return boolean
     */
    public function equals($object){
    	if ( $object instanceof TabloPrintItem && $object->getResource()->getId() == $this->resource->getId() && $object->getPrintType()->getId() == $this->print_type->getId() ){
    		return true;
    	}
    	return false;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function calculateTotal(){
        $this->setBasePrice($this->print_type->getUnitPrice());
        $this->setUnitPrice($this->resource->getPrintPrice($this->print_type));
        $this->setTotal($this->getQuantity() * $this->getUnitPrice());
    }


    /**
     * Set base_price
     *
     * @param string $basePrice
     * @return TabloPrintItem
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
     * @return TabloPrintItem
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
     * Set print_type
     *
     * @param \Tabloz\MainBundle\Entity\PrintType $printType
     * @return TabloPrintItem
     */
    public function setPrintType(\Tabloz\MainBundle\Entity\PrintType $printType)
    {
        $this->print_type = $printType;
    
        return $this;
    }

    /**
     * Get print_type
     *
     * @return \Tabloz\MainBundle\Entity\PrintType 
     */
    public function getPrintType()
    {
        return $this->print_type;
    }
}