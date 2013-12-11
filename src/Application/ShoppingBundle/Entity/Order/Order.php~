<?php

namespace Application\ShoppingBundle\Entity\Order;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="`order`")
 * @ORM\HasLifecycleCallbacks()
 */
class Order
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
    private $code;
    
    /**
     * @ORM\Column(type="string")
     */
    private $total = 0;
    
    /**
     * @ORM\OneToOne(targetEntity="Application\ShoppingBundle\Entity\Cart\Cart", inversedBy="order", cascade={"remove"})
     * @ORM\JoinColumn(name="cart_id", referencedColumnName="id")
     **/
    private $cart;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tabloz\UserBundle\Entity\User", inversedBy="orders")
     * @ORM\JoinColumn(name="user_id", nullable=true, referencedColumnName="id")
     */
    protected $user;
    
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\Email
     */
    private $email;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $phone;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="Factory\UtilityBundle\Entity\Country", inversedBy="orders")
     * @ORM\JoinColumn(name="country_id", nullable=true, referencedColumnName="id")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="Factory\UtilityBundle\Entity\State", inversedBy="orders")
     * @ORM\JoinColumn(name="state_id", nullable=true, referencedColumnName="id")
     */
    private $state;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $city;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\Length(min="10", max="10", exactMessage="کد پستی باید 10 رقم باشد.")
     */
    private $postal_code;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $enable = true;
    
    /**
     * @ORM\Column(type="smallint")
     */
    private $vat_percent = 0;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $paid = false;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $paid_at;

    /**
     * @ORM\ManyToOne(targetEntity="OrderStatus", inversedBy="orders")
     * @ORM\JoinColumn(name="status_id", nullable=false, referencedColumnName="id")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="Application\ShoppingBundle\Entity\Payment\Account", inversedBy="orders")
     * @ORM\JoinColumn(name="account_id", nullable=true, referencedColumnName="id")
     */
    private $account;

	/**
	 * @ORM\OneToMany(targetEntity="Application\ShoppingBundle\Entity\Payment\Payment", mappedBy="order")
	 */
	protected $payments;

	/**
	 * @ORM\OneToMany(targetEntity="Application\ShoppingBundle\Entity\Payment\Refund", mappedBy="order")
	 */
	protected $refunds;
    
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
    	return $this->code.'';
    }

    /**
     * @ORM\PrePersist()
     * @return Order
     */
    public function setDefaults()
    {
    	//$this->code = str_pad($this->getId(), 10, 0, STR_PAD_LEFT);
    	$this->code = uniqid();
    	$this->total = $this->cart->getTotal() * (1 + $this->vat_percent/100);
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     * @return Order
     */
    public function updateItems()
    {
    	if ($this->isPaid()){
    		foreach ($this->cart->getItems() as $cart_item){
    			$res = $cart_item->getResource();
    			$res->decrementStock($cart_item->getQuantity());
    		}
    	}
    	return $this;
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
     * Set code
     *
     * @param string $code
     * @return Order
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set total
     *
     * @param string $total
     * @return Order
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
     * Set name
     *
     * @param string $name
     * @return Order
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Order
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Order
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Order
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Order
     */
    public function setCity($city)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set postal_code
     *
     * @param string $postalCode
     * @return Order
     */
    public function setPostalCode($postalCode)
    {
        $this->postal_code = $postalCode;
    
        return $this;
    }

    /**
     * Get postal_code
     *
     * @return string 
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     * @return Order
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
     * @return Order
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
     * @return Order
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
     * Set cart
     *
     * @param \Application\ShoppingBundle\Entity\Cart\Cart $cart
     * @return Order
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

    /**
     * Set country
     *
     * @param \Factory\UtilityBundle\Entity\Country $country
     * @return Order
     */
    public function setCountry(\Factory\UtilityBundle\Entity\Country $country = null)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return \Factory\UtilityBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set state
     *
     * @param \Factory\UtilityBundle\Entity\State $state
     * @return Order
     */
    public function setState(\Factory\UtilityBundle\Entity\State $state = null)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return \Factory\UtilityBundle\Entity\State 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set status
     *
     * @param \Application\ShoppingBundle\Entity\Order\OrderStatus $status
     * @return Order
     */
    public function setStatus(\Application\ShoppingBundle\Entity\Order\OrderStatus $status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return \Application\ShoppingBundle\Entity\Order\OrderStatus 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set account
     *
     * @param \Application\ShoppingBundle\Entity\Payment\Account $account
     * @return Order
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
     * @param \Application\ShoppingBundle\Entity\Payment\Payment $payments
     * @return Order
     */
    public function addPayment(\Application\ShoppingBundle\Entity\Payment\Payment $payments)
    {
        $this->payments[] = $payments;
    
        return $this;
    }

    /**
     * Remove payments
     *
     * @param \Application\ShoppingBundle\Entity\Payment\Payment $payments
     */
    public function removePayment(\Application\ShoppingBundle\Entity\Payment\Payment $payments)
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
     * Add refunds
     *
     * @param \Application\ShoppingBundle\Entity\Payment\Refund $refunds
     * @return Order
     */
    public function addRefund(\Application\ShoppingBundle\Entity\Payment\Refund $refunds)
    {
        $this->refunds[] = $refunds;
    
        return $this;
    }

    /**
     * Remove refunds
     *
     * @param \Application\ShoppingBundle\Entity\Payment\Refund $refunds
     */
    public function removeRefund(\Application\ShoppingBundle\Entity\Payment\Refund $refunds)
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

    /**
     * Set paid
     *
     * @param boolean $paid
     * @return Order
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;
    
        return $this;
    }

    /**
     * Get paid
     *
     * @return boolean 
     */
    public function isPaid()
    {
        return $this->paid;
    }

    /**
     * Get paid
     *
     * @return boolean 
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * Set paid_at
     *
     * @param \DateTime $paidAt
     * @return Order
     */
    public function setPaidAt($paidAt)
    {
        $this->paid_at = $paidAt;
    
        return $this;
    }

    /**
     * Get paid_at
     *
     * @return \DateTime 
     */
    public function getPaidAt()
    {
        return $this->paid_at;
    }

    /**
     * Set vat_percent
     *
     * @param integer $vatPercent
     * @return Order
     */
    public function setVatPercent($vatPercent)
    {
        $this->vat_percent = $vatPercent;
    
        return $this;
    }

    /**
     * Get vat_percent
     *
     * @return integer 
     */
    public function getVatPercent()
    {
        return $this->vat_percent;
    }

    /**
     * Set user
     *
     * @param \Tabloz\UserBundle\Entity\User $user
     * @return Order
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
}