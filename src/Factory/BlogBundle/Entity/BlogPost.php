<?php

namespace Factory\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Factory\BlogBundle\Entity\BlogPostRepository")
 * @ORM\Table(name="blog_post")
 */
class BlogPost
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
     * @Assert\NotBlank(message="عنوان پست را وارد کنید.")
     * @Assert\Length(max="1000", maxMessage="عنوان طولانی است.")
     */
    private $title;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $abstract;
    
    /**
     * @ORM\Column(type="text")
     */
    private $content;
    
    /**
     * @ORM\Column(type="text")
     */
    private $raw_content;
    
    /**
     * @ORM\Column(type="string")
     */
    private $content_formatter;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $image;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tabloz\UserBundle\Entity\User", inversedBy="blog_posts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $enable = true;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $view_count = 0;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $comment_count = 0;
    
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
     * @ORM\OneToMany(targetEntity="Factory\BlogBundle\Entity\BlogPostComment", mappedBy="blog_post")
     */
    protected $comments;

    
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
     * @return BlogPost
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
     * Set abstract
     *
     * @param string $abstract
     * @return BlogPost
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
    
        return $this;
    }

    /**
     * Get abstract
     *
     * @return string 
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return BlogPost
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set raw_content
     *
     * @param string $rawContent
     * @return BlogPost
     */
    public function setRawContent($rawContent)
    {
        $this->raw_content = $rawContent;
    
        return $this;
    }

    /**
     * Get raw_content
     *
     * @return string 
     */
    public function getRawContent()
    {
        return $this->raw_content;
    }

    /**
     * Set content_formatter
     *
     * @param string $contentFormatter
     * @return BlogPost
     */
    public function setContentFormatter($contentFormatter)
    {
        $this->content_formatter = $contentFormatter;
    
        return $this;
    }

    /**
     * Get content_formatter
     *
     * @return string 
     */
    public function getContentFormatter()
    {
        return $this->content_formatter;
    }

    /**
     * Set enable
     *
     * @param boolean $enable
     * @return BlogPost
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
     * Set view_count
     *
     * @param integer $viewCount
     * @return BlogPost
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
     * @return BlogPost
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
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return BlogPost
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
     * @return BlogPost
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
     * @return BlogPost
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
     * Set user
     *
     * @param \Tabloz\UserBundle\Entity\User $user
     * @return BlogPost
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
     * Add comments
     *
     * @param \Factory\BlogBundle\Entity\BlogPostComment $comments
     * @return BlogPost
     */
    public function addComment(\Factory\BlogBundle\Entity\BlogPostComment $comments)
    {
        $this->comments[] = $comments;
    
        return $this;
    }

    /**
     * Remove comments
     *
     * @param \Factory\BlogBundle\Entity\BlogPostComment $comments
     */
    public function removeComment(\Factory\BlogBundle\Entity\BlogPostComment $comments)
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
}