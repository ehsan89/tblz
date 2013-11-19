<?php

namespace Application\ShoppingBundle\Entity\Payment;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="credit_payment")
 */
class CreditPayment extends Payment
{
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $reference_number;

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var \Application\ShoppingBundle\Entity\Order\Order
     */
    protected $order;
    
    
    public function __construct()
    {
        // your own logic
    }

    /**
     * Set reference_number
     *
     * @param string $referenceNumber
     * @return CreditPayment
     */
    public function setReferenceNumber($referenceNumber)
    {
        $this->reference_number = $referenceNumber;
    
        return $this;
    }

    /**
     * Get reference_number
     *
     * @return string 
     */
    public function getReferenceNumber()
    {
        return $this->reference_number;
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
     * Set order
     *
     * @param \Application\ShoppingBundle\Entity\Order\Order $order
     * @return CreditPayment
     */
    public function setOrder(\Application\ShoppingBundle\Entity\Order\Order $order = null)
    {
        $this->order = $order;
    
        return $this;
    }

    /**
     * Get order
     *
     * @return \Application\ShoppingBundle\Entity\Order\Order 
     */
    public function getOrder()
    {
        return $this->order;
    }
}