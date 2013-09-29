<?php

namespace Tabloz\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="tablo_tell_friend")
 */
class TabloTellFriend
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     */
    private $from_name;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Email()
     */
    private $from_email;
    
    /**
     * @ORM\Column(type="string", nullable=false)
     * @Assert\Email()
     */
    private $to_email;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $message;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tablo", inversedBy="tell_friends")
     * @ORM\JoinColumn(name="tablo_id", referencedColumnName="id")
     */
    protected $tablo;
    
    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $created_at;

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
     * Set from_name
     *
     * @param string $fromName
     * @return TabloTellFriend
     */
    public function setFromName($fromName)
    {
        $this->from_name = $fromName;
    
        return $this;
    }

    /**
     * Get from_name
     *
     * @return string 
     */
    public function getFromName()
    {
        return $this->from_name;
    }

    /**
     * Set from_email
     *
     * @param string $fromEmail
     * @return TabloTellFriend
     */
    public function setFromEmail($fromEmail)
    {
        $this->from_email = $fromEmail;
    
        return $this;
    }

    /**
     * Get from_email
     *
     * @return string 
     */
    public function getFromEmail()
    {
        return $this->from_email;
    }

    /**
     * Set to_email
     *
     * @param string $toEmail
     * @return TabloTellFriend
     */
    public function setToEmail($toEmail)
    {
        $this->to_email = $toEmail;
    
        return $this;
    }

    /**
     * Get to_email
     *
     * @return string 
     */
    public function getToEmail()
    {
        return $this->to_email;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return TabloTellFriend
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return TabloTellFriend
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
     * Set tablo
     *
     * @param \Tabloz\MainBundle\Entity\Tablo $tablo
     * @return TabloTellFriend
     */
    public function setTablo(\Tabloz\MainBundle\Entity\Tablo $tablo = null)
    {
        $this->tablo = $tablo;
    
        return $this;
    }

    /**
     * Get tablo
     *
     * @return \Tabloz\MainBundle\Entity\Tablo 
     */
    public function getTablo()
    {
        return $this->tablo;
    }
}