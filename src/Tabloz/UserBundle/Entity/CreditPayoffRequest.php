<?php

namespace Tabloz\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="credit_payoff_request")
 */
class CreditPayoffRequest
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
    private $credit;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $description;

	/**
	 * @ORM\Column(type="string")
	 */
	private $debit_card_number;

	/**
	 * @ORM\Column(type="string")
	 */
	private $bank_account_number;

	/**
	 * @ORM\ManyToOne(targetEntity="Tabloz\UserBundle\Entity\User", inversedBy="credit_payoff_requests")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 */
	protected $user;

	/**
	 * @ORM\ManyToOne(targetEntity="CreditPayoffRequestStatus", inversedBy="requests")
	 * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
	 */
	protected $status;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set credit
     *
     * @param integer $credit
     * @return CreditPayoffRequest
     */
    public function setCredit($credit)
    {
        $this->credit = $credit;
    
        return $this;
    }

    /**
     * Get credit
     *
     * @return integer 
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return CreditPayoffRequest
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
     * Set debit_card_number
     *
     * @param string $debitCardNumber
     * @return CreditPayoffRequest
     */
    public function setDebitCardNumber($debitCardNumber)
    {
        $this->debit_card_number = $debitCardNumber;
    
        return $this;
    }

    /**
     * Get debit_card_number
     *
     * @return string 
     */
    public function getDebitCardNumber()
    {
        return $this->debit_card_number;
    }

    /**
     * Set bank_account_number
     *
     * @param string $bankAccountNumber
     * @return CreditPayoffRequest
     */
    public function setBankAccountNumber($bankAccountNumber)
    {
        $this->bank_account_number = $bankAccountNumber;
    
        return $this;
    }

    /**
     * Get bank_account_number
     *
     * @return string 
     */
    public function getBankAccountNumber()
    {
        return $this->bank_account_number;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return CreditPayoffRequest
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
     * @return CreditPayoffRequest
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
     * Set user
     *
     * @param \Tabloz\UserBundle\Entity\User $user
     * @return CreditPayoffRequest
     */
    public function setUser(\Tabloz\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Tabloz\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set status
     *
     * @param \Tabloz\UserBundle\Entity\CreditPayoffRequestStatus $status
     * @return CreditPayoffRequest
     */
    public function setStatus(\Tabloz\UserBundle\Entity\CreditPayoffRequestStatus $status = null)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return \Tabloz\UserBundle\Entity\CreditPayoffRequestStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }
}