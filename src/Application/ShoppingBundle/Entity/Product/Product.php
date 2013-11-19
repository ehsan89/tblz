<?php

namespace Application\ShoppingBundle\Entity\Product;

use Application\ShoppingBundle\Model\SellableInterface;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product implements SellableInterface
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
     * @Assert\NotBlank(message="عنوان را وارد کنید.")
     * @Assert\Length(max="1000", maxMessage="عنوان طولانی است.")
     */
    private $title;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="ProductCategory", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", nullable=false, referencedColumnName="id")
     */
    protected $category;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"remove"})
     */
    private $image;
    
    /**
     * @ORM\Column(type="string")
     */
    private $unit_price = 0;
    
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
    private $favorite_count = 0;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $buy_count = 0;
    
    /**
     * @ORM\Column(type="integer")
     */
    private $stock_count = 0;
    
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
     * @ORM\ManyToMany(targetEntity="Tabloz\UserBundle\Entity\User", inversedBy="favorite_products", cascade={"remove"})
     * @ORM\JoinTable(name="user_favorite_product")
     **/
    protected $favorite_users;
    

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
	 * Returns the name of the item used in the cart view
     */
    public function getSellableName(){
    	return $this->title.'';
    }
	
	/**
	 * Returns the view of the item in the cart (object parameter will be passed to this template)
	 */
	public function getCartView(){
		return 'ApplicationShoppingBundle:Product:product_cart_view.html.twig';
	}
    
    /**
	 * Check whether the item is in stock or not
     */
    public function isInStock(){
    	return ($this->stock_count > 0) ? true : false;
    }
    
    /**
	 * Decrement the stock count and update the buy count of the item
	 * 
	 * @param integer $count
     * @return Product
     */
    public function decrementStock($count){
    	$this->stock_count -= $count;
    	$this->buy_count += $count;
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
     * Set title
     *
     * @param string $title
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * @return Product
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
     * Set favorite_count
     *
     * @param integer $favoriteCount
     * @return Product
     */
    public function setFavoriteCount($favoriteCount)
    {
        $this->favorite_count = $favoriteCount;
    
        return $this;
    }

    /**
     * Get favorite_count
     *
     * @return integer 
     */
    public function getFavoriteCount()
    {
        return $this->favorite_count;
    }

    /**
     * Set buy_count
     *
     * @param integer $buyCount
     * @return Product
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
     * Set stock_count
     *
     * @param integer $stockCount
     * @return Product
     */
    public function setStockCount($stockCount)
    {
        $this->stock_count = $stockCount;
    
        return $this;
    }

    /**
     * Get stock_count
     *
     * @return integer 
     */
    public function getStockCount()
    {
        return $this->stock_count;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Product
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
     * @return Product
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
     * @param \Application\ShoppingBundle\Entity\Product\ProductCategory $category
     * @return Product
     */
    public function setCategory(\Application\ShoppingBundle\Entity\Product\ProductCategory $category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Application\ShoppingBundle\Entity\Product\ProductCategory 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set image
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $image
     * @return Product
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
     * Add favorite_users
     *
     * @param \Tabloz\UserBundle\Entity\User $favoriteUsers
     * @return Product
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
     * Set unit_price
     *
     * @param string $unitPrice
     * @return Product
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unit_price = $unitPrice;
    
        return $this;
    }

    /**
     * Get unit_price
     *
     * @return string 
     */
    public function getUnitPrice()
    {
        return $this->unit_price;
    }
}