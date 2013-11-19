<?php

namespace Application\ShoppingBundle\Entity\Payment;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="web_payment")
 */
class WebPayment extends Payment
{

    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="web_payments")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     */
    private $account;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $reference_number;
    
    /**
     * @ORM\ManyToOne(targetEntity="TransactionState", inversedBy="payments")
     * @ORM\JoinColumn(name="transaction_state_id", nullable=true, referencedColumnName="id")
     */
    protected $transaction_state;
    
    /**
     * @ORM\ManyToOne(targetEntity="TransactionState", inversedBy="payments")
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
     * @return WebPayment
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
     * Set account
     *
     * @param \Application\ShoppingBundle\Entity\Payment\Account $account
     * @return WebPayment
     */
    public function setAccount(\Application\ShoppingBundle\Entity\Payment\Account $account = null)
    {
        $this->account = $account;
    
        return $this;
    }

    /**
     * Get account
     *
     * @return \Application\ShoppingBundle\Entity\Payment\Account 
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set transaction_state
     *
     * @param \Application\ShoppingBundle\Entity\Payment\TransactionState $transactionState
     * @return WebPayment
     */
    public function setTransactionState(\Application\ShoppingBundle\Entity\Payment\TransactionState $transactionState = null)
    {
        $this->transaction_state = $transactionState;
    
        return $this;
    }

    /**
     * Get transaction_state
     *
     * @return \Application\ShoppingBundle\Entity\Payment\TransactionState 
     */
    public function getTransactionState()
    {
        return $this->transaction_state;
    }

    /**
     * Set verification_state
     *
     * @param \Application\ShoppingBundle\Entity\Payment\TransactionState $verificationState
     * @return WebPayment
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
     * @return WebPayment
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