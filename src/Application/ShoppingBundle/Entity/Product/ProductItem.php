<?php

namespace Application\ShoppingBundle\Entity\Product;

use Application\ShoppingBundle\Entity\Cart\CartItem;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="product_item")
 * @ORM\HasLifecycleCallbacks
 */
class ProductItem extends CartItem
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
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="product_items")
     * @ORM\JoinColumn(name="product_id", nullable=false, referencedColumnName="id")
     */
    protected $resource;

    public function __construct()
    {
    }
    
    /**
     * Checks whether the given object is equal to this object
     * @param $object
     * @return boolean
     */
    public function equals($object){
    	if ( $object instanceof ProductItem && $object->getResource()->getId() == $this->resource->getId() ){
    		return true;
    	}
    	return false;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function calculateTotal(){
        $this->setUnitPrice($this->getResource()->getUnitPrice());
        $this->setTotal($this->getQuantity() * $this->resource->getUnitPrice());
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
     * Set resource
     *
     * @param \Application\ShoppingBundle\Entity\Product\Product $resource
     * @return ProductItem
     */
    public function setResource(\Application\ShoppingBundle\Entity\Product\Product $resource)
    {
        $this->resource = $resource;
    
        return $this;
    }

    /**
     * Get resource
     *
     * @return \Application\ShoppingBundle\Entity\Product\Product 
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set cart
     *
     * @param \Application\ShoppingBundle\Entity\Cart\Cart $cart
     * @return ProductItem
     */
    public function setCart(\Application\ShoppingBundle\Entity\Cart\Cart $cart = null)
    {
        $this->cart = $cart;
    
        return $this;
    }

    /**
     * Get cart
     *
     * @return \Application\ShoppingBundle\Entity\Cart\Cart 
     */
    public function getCart()
    {
        return $this->cart;
    }
}