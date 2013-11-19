<?php

namespace Application\ShoppingBundle\Entity\Payment;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="transaction_state")
 */
class TransactionState
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
    private $code_name;
    
    /**
     * @ORM\Column(type="text")
     */
    private $code_description;
    
    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="transaction_states")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     */
    protected $account;

    /**
     * @ORM\OneToMany(targetEntity="WebPayment", mappedBy="transaction_state")
     */
    protected $payments;

    /**
     * @ORM\OneToMany(targetEntity="WebPayment", mappedBy="verification_state")
     */
    protected $verified_payments;

    /**
     * @ORM\OneToMany(targetEntity="WebRefund", mappedBy="verification_state")
     */
    protected $refunds;
    
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
     * Set code_name
     *
     * @param string $codeName
     * @return TransactionState
     */
    public function setCodeName($codeName)
    {
        $this->code_name = $codeName;
    
        return $this;
    }

    /**
     * Get code_name
     *
     * @return string 
     */
    public function getCodeName()
    {
        return $this->code_name;
    }

    /**
     * Set code_description
     *
     * @param string $codeDescription
     * @return TransactionState
     */
    public function setCodeDescription($codeDescription)
    {
        $this->code_description = $codeDescription;
    
        return $this;
    }

    /**
     * Get code_description
     *
     * @return string 
     */
    public function getCodeDescription()
    {
        return $this->code_description;
    }

    /**
     * Set account
     *
     * @param \Application\ShoppingBundle\Entity\Payment\Account $account
     * @return TransactionState
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
     * Add payments
     *
     * @param \Application\ShoppingBundle\Entity\Payment\WebPayment $payments
     * @return TransactionState
     */
    public function addPayment(\Application\ShoppingBundle\Entity\Payment\WebPayment $payments)
    {
        $this->payments[] = $payments;
    
        return $this;
    }

    /**
     * Remove payments
     *
     * @param \Application\ShoppingBundle\Entity\Payment\WebPayment $payments
     */
    public function removePayment(\Application\ShoppingBundle\Entity\Payment\WebPayment $payments)
    {
        $this->payments->removeElement($payments);
    }

    /**
     * Get payments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * Add verified_payments
     *
     * @param \Application\ShoppingBundle\Entity\Payment\WebPayment $verifiedPayments
     * @return TransactionState
     */
    public function addVerifiedPayment(\Application\ShoppingBundle\Entity\Payment\WebPayment $verifiedPayments)
    {
        $this->verified_payments[] = $verifiedPayments;
    
        return $this;
    }

    /**
     * Remove verified_payments
     *
     * @param \Application\ShoppingBundle\Entity\Payment\WebPayment $verifiedPayments
     */
    public function removeVerifiedPayment(\Application\ShoppingBundle\Entity\Payment\WebPayment $verifiedPayments)
    {
        $this->verified_payments->removeElement($verifiedPayments);
    }

    /**
     * Get verified_payments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVerifiedPayments()
    {
        return $this->verified_payments;
    }

    /**
     * Add refunds
     *
     * @param \Application\ShoppingBundle\Entity\Payment\WebRefund $refunds
     * @return TransactionState
     */
    public function addRefund(\Application\ShoppingBundle\Entity\Payment\WebRefund $refunds)
    {
        $this->refunds[] = $refunds;
    
        return $this;
    }

    /**
     * Remove refunds
     *
     * @param \Application\ShoppingBundle\Entity\Payment\WebRefund $refunds
     */
    public function removeRefund(\Application\ShoppingBundle\Entity\Payment\WebRefund $refunds)
    {
        $this->refunds->removeElement($refunds);
    }

    /**
     * Get refunds
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRefunds()
    {
        return $this->refunds;
    }
}