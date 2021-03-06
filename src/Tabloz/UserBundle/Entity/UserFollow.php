<?php

namespace Tabloz\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_follow")
 */
class UserFollow
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tabloz\UserBundle\Entity\User", inversedBy="followers")
     * @ORM\JoinColumn(name="follower_id", referencedColumnName="id")
     */
    protected $follower;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tabloz\UserBundle\Entity\User", inversedBy="followees")
     * @ORM\JoinColumn(name="followee_id", referencedColumnName="id")
     */
    protected $followee;
    
    public function __construct()
    {
        // your own logic
    }


    /**
     * Set follower
     *
     * @param \Tabloz\UserBundle\Entity\User $follower
     * @return UserFollow
     */
    public function setFollower(\Tabloz\UserBundle\Entity\User $follower = null)
    {
        $this->follower = $follower;

        return $this;
    }

    /**
     * Get follower
     *
     * @return \Tabloz\UserBundle\Entity\User 
     */
    public function getFollower()
    {
        return $this->follower;
    }

    /**
     * Set followee
     *
     * @param \Tabloz\UserBundle\Entity\User $followee
     * @return UserFollow
     */
    public function setFollowee(\Tabloz\UserBundle\Entity\User $followee = null)
    {
        $this->followee = $followee;

        return $this;
    }

    /**
     * Get followee
     *
     * @return \Tabloz\UserBundle\Entity\User 
     */
    public function getFollowee()
    {
        return $this->followee;
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
}