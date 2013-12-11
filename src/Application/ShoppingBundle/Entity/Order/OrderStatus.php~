<?php

namespace Application\ShoppingBundle\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="order_status")
 */
class OrderStatus
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", unique = true)
     */
    private $title;
    
    /**
     * @ORM\Column(type="string", unique = true)
     */
    private $descriptor;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    
    /**
     * @ORM\OneToMany(targetEntity="Order", mappedBy="status")
     */
    protected $orders;
    

    public function __construct()
    {
        // your own logic
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
     * @return OrderStatus
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
     * @return OrderStatus
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
     * @return OrderStatus
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
     * Add orders
     *
     * @param \Application\ShoppingBundle\Entity\Order\Order $orders
     * @return OrderStatus
     */
    public function addOrder(\Application\ShoppingBundle\Entity\Order\Order $orders)
    {
        $this->orders[] = $orders;
    
        return $this;
    }

    /**
     * Remove orders
     *
     * @param \Application\ShoppingBundle\Entity\Order\Order $orders
     */
    public function removeOrder(\Application\ShoppingBundle\Entity\Order\Order $orders)
    {
        $this->orders->removeElement($orders);
    }

    /**
     * Get orders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOrders()
    {
        return $this->orders;
    }
}