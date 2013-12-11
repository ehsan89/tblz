<?php

namespace Tabloz\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="credit_payoff_request_status")
 */
class CreditPayoffRequestStatus
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
	private $descriptor;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private $description;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $enable = true;
    
    /**
     * @ORM\OneToMany(targetEntity="CreditPayoffRequest", mappedBy="status")
     */
    protected $requests;
    
    
    public function __construct()
    {
        // your own logic
    }

	/**
	 * {@inheritDoc}
	 */
	public function __toString() {
		return $this->getTitle();
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
     * @return CreditPayoffRequestStatus
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
     * @return CreditPayoffRequestStatus
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
     * @return CreditPayoffRequestStatus
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
     * Set enable
     *
     * @param boolean $enable
     * @return CreditPayoffRequestStatus
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
     * Add requests
     *
     * @param \Tabloz\UserBundle\Entity\CreditPayoffRequest $requests
     * @return CreditPayoffRequestStatus
     */
    public function addRequest(\Tabloz\UserBundle\Entity\CreditPayoffRequest $requests)
    {
        $this->requests[] = $requests;
    
        return $this;
    }

    /**
     * Remove requests
     *
     * @param \Tabloz\UserBundle\Entity\CreditPayoffRequest $requests
     */
    public function removeRequest(\Tabloz\UserBundle\Entity\CreditPayoffRequest $requests)
    {
        $this->requests->removeElement($requests);
    }

    /**
     * Get requests
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRequests()
    {
        return $this->requests;
    }
}