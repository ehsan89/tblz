<?php

namespace Application\ShoppingBundle\Entity\Payment;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="account")
 */
class Account
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
    private $title;
    
    /**
     * @ORM\Column(type="string")
     */
    private $number;
    
    /**
     * @ORM\Column(type="string")
     */
    private $owner_name;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $card_number;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $merchant_id;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $merchant_password;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $link;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $wsp_link;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"remove"})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="Application\ShoppingBundle\Entity\Order\Order", mappedBy="account")
     */
    protected $orders;

    /**
     * @ORM\OneToMany(targetEntity="TransactionState", mappedBy="account")
     */
    protected $transaction_states;

    /**
     * @ORM\OneToMany(targetEntity="WebPayment", mappedBy="account")
     */
    protected $web_payments;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $enable = true;
    
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
	 * @return Account
	 */
	public function setTitle($title) {
		$this->title = $title;

		return $this;
	}

	/**
	 * Get title
	 *
	 * @return string 
	 */
	public function getTitle() {
		return $this->title;
	}

    /**
     * Set number
     *
     * @param string $number
     * @return Account
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set owner_name
     *
     * @param string $ownerName
     * @return Account
     */
    public function setOwnerName($ownerName)
    {
        $this->owner_name = $ownerName;
    
        return $this;
    }

    /**
     * Get owner_name
     *
     * @return string 
     */
    public function getOwnerName()
    {
        return $this->owner_name;
    }

    /**
     * Set card_number
     *
     * @param string $cardNumber
     * @return Account
     */
    public function setCardNumber($cardNumber)
    {
        $this->card_number = $cardNumber;
    
        return $this;
    }

    /**
     * Get card_number
     *
     * @return string 
     */
    public function getCardNumber()
    {
        return $this->card_number;
    }

    /**
     * Set merchant_id
     *
     * @param string $merchantId
     * @return Account
     */
    public function setMerchantId($merchantId)
    {
        $this->merchant_id = $merchantId;
    
        return $this;
    }

    /**
     * Get merchant_id
     *
     * @return string 
     */
    public function getMerchantId()
    {
        return $this->merchant_id;
    }

    /**
     * Set link
     *
     * @param string $link
     * @return Account
     */
    public function setLink($link)
    {
        $this->link = $link;
    
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set wsp_link
     *
     * @param string $wspLink
     * @return Account
     */
    public function setWspLink($wspLink)
    {
        $this->wsp_link = $wspLink;
    
        return $this;
    }

    /**
     * Get wsp_link
     *
     * @return string 
     */
    public function getWspLink()
    {
        return $this->wsp_link;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     * @return Account
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;
    
        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean 
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Account
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
     * @return Account
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
     * Set image
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $image
     * @return Account
     */
    public function setImage(\Application\Sonata\MediaBundle\Entity\Media $image = null)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add orders
     *
     * @param \Application\ShoppingBundle\Entity\Order\Order $orders
     * @return Account
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

    /**
     * Add transaction_states
     *
     * @param \Application\ShoppingBundle\Entity\Payment\TransactionState $transactionStates
     * @return Account
     */
    public function addTransactionState(\Application\ShoppingBundle\Entity\Payment\TransactionState $transactionStates)
    {
        $this->transaction_states[] = $transactionStates;
    
        return $this;
    }

    /**
     * Remove transaction_states
     *
     * @param \Application\ShoppingBundle\Entity\Payment\TransactionState $transactionStates
     */
    public function removeTransactionState(\Application\ShoppingBundle\Entity\Payment\TransactionState $transactionStates)
    {
        $this->transaction_states->removeElement($transactionStates);
    }

    /**
     * Get transaction_states
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTransactionStates()
    {
        return $this->transaction_states;
    }

    /**
     * Add web_payments
     *
     * @param \Application\ShoppingBundle\Entity\Payment\WebPayment $webPayments
     * @return Account
     */
    public function addWebPayment(\Application\ShoppingBundle\Entity\Payment\WebPayment $webPayments)
    {
        $this->web_payments[] = $webPayments;
    
        return $this;
    }

    /**
     * Remove web_payments
     *
     * @param \Application\ShoppingBundle\Entity\Payment\WebPayment $webPayments
     */
    public function removeWebPayment(\Application\ShoppingBundle\Entity\Payment\WebPayment $webPayments)
    {
        $this->web_payments->removeElement($webPayments);
    }

    /**
     * Get web_payments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getWebPayments()
    {
        return $this->web_payments;
    }

    /**
     * Set merchant_password
     *
     * @param string $merchantPassword
     * @return Account
     */
    public function setMerchantPassword($merchantPassword)
    {
        $this->merchant_password = $merchantPassword;
    
        return $this;
    }

    /**
     * Get merchant_password
     *
     * @return string 
     */
    public function getMerchantPassword()
    {
        return $this->merchant_password;
    }
}