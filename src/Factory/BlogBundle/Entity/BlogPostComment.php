<?php

namespace Factory\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog_post_comment")
 */
class BlogPostComment
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $content;
    
    /**
     * @ORM\ManyToOne(targetEntity="Tabloz\UserBundle\Entity\User", inversedBy="blog_post_comments")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="BlogPost", inversedBy="comments")
     * @ORM\JoinColumn(name="blog_post_id", referencedColumnName="id")
     */
    protected $blog_post;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $enable = true;
    
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
     * Set content
     *
     * @param string $content
     * @return BlogPostComment
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
     * Set enable
     *
     * @param boolean $enable
     * @return BlogPostComment
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
     * @return BlogPostComment
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
     * Set user
     *
     * @param \Tabloz\UserBundle\Entity\User $user
     * @return BlogPostComment
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
     * Set blog_post
     *
     * @param \Factory\BlogBundle\Entity\BlogPost $blogPost
     * @return BlogPostComment
     */
    public function setBlogPost(\Factory\BlogBundle\Entity\BlogPost $blogPost = null)
    {
        $this->blog_post = $blogPost;
    
        return $this;
    }

    /**
     * Get blog_post
     *
     * @return \Factory\BlogBundle\Entity\BlogPost 
     */
    public function getBlogPost()
    {
        return $this->blog_post;
    }
}