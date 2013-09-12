<?php

namespace Tabloz\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="tablo")
 */
class Tablo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=1000)
     *
     * @Assert\NotBlank(message="عنوان اثر را وارد کنید.")
     * @Assert\Length(max="1000", maxMessage="عنوان طولانی است.")
     */
    private $title;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="TabloCategory", inversedBy="tablos")
     * @ORM\JoinColumn(name="category_id", nullable=false, referencedColumnName="id")
     */
    protected $category;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tabloz\UserBundle\Entity\User", inversedBy="tablos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $image;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $curated = false;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $enable = true;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $private = true;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $view_count = 0;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $comment_count = 0;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $buy_count = 0;
    
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
    
    /**
     * @ORM\OneToMany(targetEntity="Tabloz\MainBundle\Entity\TabloComment", mappedBy="tablo")
     */
    protected $comments;

    /**
     * @ORM\ManyToMany(targetEntity="Tabloz\UserBundle\Entity\User", inversedBy="favorite_tablos")
     * @ORM\JoinTable(name="user_favorite_tablo")
     **/
    protected $favorite_users;
    
    /**
     * @ORM\OneToMany(targetEntity="Tabloz\MainBundle\Entity\TabloTellFriend", mappedBy="tablo")
     */
    protected $tell_firends;
    

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
     * @return Tablo
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
     * Set description
     *
     * @param string $description
     * @return Tablo
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
     * Set curated
     *
     * @param boolean $curated
     * @return Tablo
     */
    public function setCurated($curated)
    {
        $this->curated = $curated;

        return $this;
    }

    /**
     * Get curated
     *
     * @return boolean 
     */
    public function getCurated()
    {
        return $this->curated;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     * @return Tablo
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
     * Set private
     *
     * @param boolean $private
     * @return Tablo
     */
    public function setPrivate($private)
    {
        $this->private = $private;

        return $this;
    }

    /**
     * Get private
     *
     * @return boolean 
     */
    public function getPrivate()
    {
        return $this->private;
    }

    /**
     * Set view_count
     *
     * @param integer $viewCount
     * @return Tablo
     */
    public function setViewCount($viewCount)
    {
        $this->view_count = $viewCount;

        return $this;
    }

    /**
     * Get view_count
     *
     * @return integer 
     */
    public function getViewCount()
    {
        return $this->view_count;
    }

    /**
     * Set comment_count
     *
     * @param integer $commentCount
     * @return Tablo
     */
    public function setCommentCount($commentCount)
    {
        $this->comment_count = $commentCount;

        return $this;
    }

    /**
     * Get comment_count
     *
     * @return integer 
     */
    public function getCommentCount()
    {
        return $this->comment_count;
    }

    /**
     * Set buy_count
     *
     * @param integer $buyCount
     * @return Tablo
     */
    public function setBuyCount($buyCount)
    {
        $this->buy_count = $buyCount;

        return $this;
    }

    /**
     * Get buy_count
     *
     * @return integer 
     */
    public function getBuyCount()
    {
        return $this->buy_count;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Tablo
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
     * @return Tablo
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
     * Set category
     *
     * @param \Tabloz\MainBundle\Entity\TabloCategory $category
     * @return Tablo
     */
    public function setCategory(\Tabloz\MainBundle\Entity\TabloCategory $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Tabloz\MainBundle\Entity\TabloCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set user
     *
     * @param \Tabloz\UserBundle\Entity\User $user
     * @return Tablo
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
     * Set image
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $image
     * @return Tablo
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
     * Add comments
     *
     * @param \Tabloz\MainBundle\Entity\TabloComment $comments
     * @return Tablo
     */
    public function addComment(\Tabloz\MainBundle\Entity\TabloComment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Tabloz\MainBundle\Entity\TabloComment $comments
     */
    public function removeComment(\Tabloz\MainBundle\Entity\TabloComment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add favorite_users
     *
     * @param \Tabloz\UserBundle\Entity\User $favoriteUsers
     * @return Tablo
     */
    public function addFavoriteUser(\Tabloz\UserBundle\Entity\User $favoriteUsers)
    {
        $this->favorite_users[] = $favoriteUsers;

        return $this;
    }

    /**
     * Remove favorite_users
     *
     * @param \Tabloz\UserBundle\Entity\User $favoriteUsers
     */
    public function removeFavoriteUser(\Tabloz\UserBundle\Entity\User $favoriteUsers)
    {
        $this->favorite_users->removeElement($favoriteUsers);
    }

    /**
     * Get favorite_users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFavoriteUsers()
    {
        return $this->favorite_users;
    }
    
    /**
     * Get the count of the favorite users
     */
    public function getFavoriteCount()
    {
    	return count($this->favorite_users);
    }

    /**
     * Add tell_firends
     *
     * @param \Tabloz\MainBundle\Entity\TabloTellFriend $tellFirends
     * @return Tablo
     */
    public function addTellFirend(\Tabloz\MainBundle\Entity\TabloTellFriend $tellFirends)
    {
        $this->tell_firends[] = $tellFirends;
    
        return $this;
    }

    /**
     * Remove tell_firends
     *
     * @param \Tabloz\MainBundle\Entity\TabloTellFriend $tellFirends
     */
    public function removeTellFirend(\Tabloz\MainBundle\Entity\TabloTellFriend $tellFirends)
    {
        $this->tell_firends->removeElement($tellFirends);
    }

    /**
     * Get tell_firends
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTellFirends()
    {
        return $this->tell_firends;
    }
}