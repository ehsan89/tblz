<?php

namespace Tabloz\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Sonata\UserBundle\Model\User as AbstractedUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="tabloz_user")
 */
class User extends AbstractedUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     */
    protected $createdAt;


    /**
     * @ORM\Column(type="datetime", name="updated_at")
     */
    protected $updatedAt;
    
    /**
     * @ORM\Column(type="string", name="two_step_code")
     */
    protected $twoStepVerificationCode;
    
    /**
     * @ORM\Column(type="datetime", name="date_of_birth")
     */
    protected $dateOfBirth;
    
    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    protected $firstname;
    
    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    protected $lastname;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $website;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $biography;
    
    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    protected $gender = UserInterface::GENDER_UNKNOWN; // set the default to unknown
    
    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    protected $phone;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $token;

    /**
     * @ORM\Column(type="string", name="facebook_uid", nullable=true)
     */
    protected $facebookUid;

    /**
     * @ORM\Column(type="string", name="facebook_name", nullable=true)
     */
    protected $facebookName;

    /**
     * @ORM\Column(type="json", name="facebook_data", nullable=true)
     */
    protected $facebookData;

    /**
     * @ORM\Column(type="string", name="twitter_uid", nullable=true)
     */
    protected $twitterUid;

    /**
     * @ORM\Column(type="string", name="twitter_name", nullable=true)
     */
    protected $twitterName;

    /**
     * @ORM\Column(type="json", name="twitter_data", nullable=true)
     */
    protected $twitterData;

    /**
     * @ORM\Column(type="string", name="gplus_uid", nullable=true)
     */
    protected $gplusUid;

    /**
     * @ORM\Column(type="string", name="gplus_name", nullable=true)
     */
    protected $gplusName;

    /**
     * @ORM\Column(type="json", name="gplus_data", nullable=true)
     */
    protected $gplusData;
    
    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $mobile;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;
    
    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $postal_code;
    
    /**
     * @var integer $credit
     *
     * @ORM\Column(type="integer", length=4)
     */
    private $credit = 0;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $premium = false;
    
    /**
     * @ORM\ManyToMany(targetEntity="Tabloz\MainBundle\Entity\Tablo", mappedBy="favorite_users")
     **/
    protected $favorite_tablos;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Factory\UtilityBundle\Entity\Country", inversedBy="users")
     * @ORM\JoinColumn(name="country_id", nullable=true, referencedColumnName="id")
     */
    private $country;

    /**
     * @ORM\ManyToOne(targetEntity="Factory\UtilityBundle\Entity\State", inversedBy="users")
     * @ORM\JoinColumn(name="state_id", nullable=true, referencedColumnName="id")
     */
    private $state;
    
    /**
     * @ORM\OneToMany(targetEntity="Tabloz\MainBundle\Entity\Tablo", mappedBy="user")
     */
    protected $tablos;
    
    /**
     * @ORM\OneToMany(targetEntity="Tabloz\MainBundle\Entity\TabloComment", mappedBy="user")
     */
    protected $tablo_comments;
    
    /**
     * @ORM\OneToMany(targetEntity="Tabloz\MainBundle\Entity\TabloCollection", mappedBy="user")
     */
    protected $tablo_collections;
    
    /**
     * @ORM\OneToMany(targetEntity="Tabloz\UserBundle\Entity\UserFollow", mappedBy="follower")
     */
    protected $followers;
    
    /**
     * @ORM\OneToMany(targetEntity="Tabloz\UserBundle\Entity\UserFollow", mappedBy="followee")
     */
    protected $followees;
    

    public function __construct()
    {
        parent::__construct();
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
     * Set mobile
     *
     * @param string $mobile
     * @return User
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
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
     * Set postal_code
     *
     * @param string $postalCode
     * @return User
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
     * Set credit
     *
     * @param integer $credit
     * @return User
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
     * Set premium
     *
     * @param boolean $premium
     * @return User
     */
    public function setPremium($premium)
    {
        $this->premium = $premium;

        return $this;
    }

    /**
     * Get premium
     *
     * @return boolean 
     */
    public function getPremium()
    {
        return $this->premium;
    }

    /**
     * Add favorite_tablos
     *
     * @param \Tabloz\MainBundle\Entity\Tablo $favoriteTablos
     * @return User
     */
    public function addFavoriteTablo(\Tabloz\MainBundle\Entity\Tablo $favoriteTablos)
    {
        $this->favorite_tablos[] = $favoriteTablos;

        return $this;
    }

    /**
     * Remove favorite_tablos
     *
     * @param \Tabloz\MainBundle\Entity\Tablo $favoriteTablos
     */
    public function removeFavoriteTablo(\Tabloz\MainBundle\Entity\Tablo $favoriteTablos)
    {
        $this->favorite_tablos->removeElement($favoriteTablos);
    }

    /**
     * Get favorite_tablos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFavoriteTablos()
    {
        return $this->favorite_tablos;
    }

    /**
     * Set image
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $image
     * @return User
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
     * Set country
     *
     * @param \Factory\UtilityBundle\Entity\Country $country
     * @return User
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
     * @return User
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
     * Add tablos
     *
     * @param \Tabloz\MainBundle\Entity\Tablo $tablos
     * @return User
     */
    public function addTablo(\Tabloz\MainBundle\Entity\Tablo $tablos)
    {
        $this->tablos[] = $tablos;

        return $this;
    }

    /**
     * Remove tablos
     *
     * @param \Tabloz\MainBundle\Entity\Tablo $tablos
     */
    public function removeTablo(\Tabloz\MainBundle\Entity\Tablo $tablos)
    {
        $this->tablos->removeElement($tablos);
    }

    /**
     * Get tablos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTablos()
    {
        return $this->tablos;
    }

    /**
     * Add tablo_comments
     *
     * @param \Tabloz\MainBundle\Entity\TabloComment $tabloComments
     * @return User
     */
    public function addTabloComment(\Tabloz\MainBundle\Entity\TabloComment $tabloComments)
    {
        $this->tablo_comments[] = $tabloComments;

        return $this;
    }

    /**
     * Remove tablo_comments
     *
     * @param \Tabloz\MainBundle\Entity\TabloComment $tabloComments
     */
    public function removeTabloComment(\Tabloz\MainBundle\Entity\TabloComment $tabloComments)
    {
        $this->tablo_comments->removeElement($tabloComments);
    }

    /**
     * Get tablo_comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTabloComments()
    {
        return $this->tablo_comments;
    }

    /**
     * Add tablo_collections
     *
     * @param \Tabloz\MainBundle\Entity\TabloCollection $tabloCollections
     * @return User
     */
    public function addTabloCollection(\Tabloz\MainBundle\Entity\TabloCollection $tabloCollections)
    {
        $this->tablo_collections[] = $tabloCollections;

        return $this;
    }

    /**
     * Remove tablo_collections
     *
     * @param \Tabloz\MainBundle\Entity\TabloCollection $tabloCollections
     */
    public function removeTabloCollection(\Tabloz\MainBundle\Entity\TabloCollection $tabloCollections)
    {
        $this->tablo_collections->removeElement($tabloCollections);
    }

    /**
     * Get tablo_collections
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTabloCollections()
    {
        return $this->tablo_collections;
    }

    /**
     * Add followers
     *
     * @param \Tabloz\UserBundle\Entity\UserFollow $followers
     * @return User
     */
    public function addFollower(\Tabloz\UserBundle\Entity\UserFollow $followers)
    {
        $this->followers[] = $followers;

        return $this;
    }

    /**
     * Remove followers
     *
     * @param \Tabloz\UserBundle\Entity\UserFollow $followers
     */
    public function removeFollower(\Tabloz\UserBundle\Entity\UserFollow $followers)
    {
        $this->followers->removeElement($followers);
    }

    /**
     * Get followers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFollowers()
    {
        return $this->followers;
    }

    /**
     * Add followees
     *
     * @param \Tabloz\UserBundle\Entity\UserFollow $followees
     * @return User
     */
    public function addFollowee(\Tabloz\UserBundle\Entity\UserFollow $followees)
    {
        $this->followees[] = $followees;

        return $this;
    }

    /**
     * Remove followees
     *
     * @param \Tabloz\UserBundle\Entity\UserFollow $followees
     */
    public function removeFollowee(\Tabloz\UserBundle\Entity\UserFollow $followees)
    {
        $this->followees->removeElement($followees);
    }

    /**
     * Get followees
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFollowees()
    {
        return $this->followees;
    }
    
    /**
     * Set the default user image media
     * 
     * @ORM\PrePersist
     */
    public function setDefaultImage(){
    	if (!$this->image){
    		$mediaRepository = $this->getDoctrine()
    		->getRepository('ApplicationSonataMediaBundle:Media');
    		$this->image = $mediaRepository->findOneByName('default-user-image');
    	}
    }

    /**
     * Hook on pre-persist operations
     */
    public function prePersist()
    {
    	$this->createdAt = new \DateTime;
    	$this->updatedAt = new \DateTime;
    }
    
    /**
     * Hook on pre-update operations
     */
    public function preUpdate()
    {
    	$this->updatedAt = new \DateTime;
    }
}
