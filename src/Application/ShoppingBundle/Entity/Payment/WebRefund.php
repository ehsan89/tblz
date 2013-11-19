<?php

namespace Application\ShoppingBundle\Entity\Payment;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="web_refund")
 */
class WebRefund extends Refund
{
    /**
     * @ORM\Column(type="string")
     */
    private $reference_number;
    
    /**
     * @ORM\ManyToOne(targetEntity="TransactionState", inversedBy="refunds")
     * @ORM\JoinColumn(name="verification_state_id", nullable=true, referencedColumnName="id")
     */
    protected $verification_state;

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
     * @return WebRefund
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
     * Set verification_state
     *
     * @param \Application\ShoppingBundle\Entity\Payment\TransactionState $verificationState
     * @return WebRefund
     */
    public function setVerificationState(\Application\ShoppingBundle\Entity\Payment\TransactionState $verificationState = null)
    {
        $this->verification_state = $verificationState;
    
        return $this;
    }

    /**
     * Get verification_state
     *
     * @return \Application\ShoppingBundle\Entity\Payment\TransactionState 
     */
    public function getVerificationState()
    {
        return $this->verification_state;
    }

    /**
     * Set order
     *
     * @param \Application\ShoppingBundle\Entity\Order\Order $order
     * @return WebRefund
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