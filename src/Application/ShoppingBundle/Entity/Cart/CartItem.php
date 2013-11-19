<?php

namespace Application\ShoppingBundle\Entity\Cart;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Application\ShoppingBundle\Entity\Cart\CartItemRepository")
 * @ORM\Table(name="cart_item")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"product_item" = "Application\ShoppingBundle\Entity\Product\ProductItem"})
 * @ORM\HasLifecycleCallbacks()
 */
class CartItem
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $quantity = 0;
    
    /**
     * @ORM\Column(type="string")
     */
    private $unit_price = 0;
    
    /**
     * @ORM\Column(type="string")
     */
    private $total = 0;
    
    /**
     * @ORM\ManyToOne(targetEntity="Cart", inversedBy="cart_items")
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     */
    protected $cart;
    
    public function __construct()
    {
        // your own logic
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
     * Set quantity
     *
     * @param integer $quantity
     * @return CartItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    
        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
    	return $this->quantity;
    }
    
    /**
     * Increment quantity
     *
     * @return integer
     */
    public function incrementQuantity($q)
    {
    	$this->quantity += $q;
    	return $this->quantity;
    }
    
    

    /**
     * Set unit_price
     *
     * @param string $unitPrice
     * @return CartItem
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
     * Set total
     *
     * @param string $total
     * @return CartItem
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return string 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set cart
     *
     * @param \Application\ShoppingBundle\Entity\Cart\Cart $cart
     * @return CartItem
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