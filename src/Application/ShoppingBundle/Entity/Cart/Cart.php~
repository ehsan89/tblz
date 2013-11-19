<?php

namespace Application\ShoppingBundle\Entity\Cart;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="Application\ShoppingBundle\Entity\Cart\CartRepository")
 * @ORM\Table(name="cart")
 * @ORM\HasLifecycleCallbacks()
 */
class Cart {
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\OneToMany(targetEntity="CartItem", mappedBy="cart", cascade={"all"})
	 */
	protected $items;

	/**
	 * @ORM\OneToOne(targetEntity="Application\ShoppingBundle\Entity\Order\Order", mappedBy="cart")
	 **/
	private $order;

	/**
	 * @ORM\ManyToOne(targetEntity="Tabloz\UserBundle\Entity\User", inversedBy="carts")
	 * @ORM\JoinColumn(name="user_id", nullable=true, referencedColumnName="id")
	 */
	protected $user;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	private $title;

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

	public function __construct() {
		// your own logic
	}

	/**
	 * Calculates and returns the cart total
	 */
	public function getTotal() {
		$total = 0;
		foreach ($this->items as $item){
			$total += $item->getTotal();
		}
		return $total;
	}

	/**
	 * Get id
	 *
	 * @return integer 
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set title
	 *
	 * @param string $title
	 * @return Cart
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
	 * Set created_at
	 *
	 * @param \DateTime $createdAt
	 * @return Cart
	 */
	public function setCreatedAt($createdAt) {
		$this->created_at = $createdAt;

		return $this;
	}

	/**
	 * Get created_at
	 *
	 * @return \DateTime 
	 */
	public function getCreatedAt() {
		return $this->created_at;
	}

	/**
	 * Set updated_at
	 *
	 * @param \DateTime $updatedAt
	 * @return Cart
	 */
	public function setUpdatedAt($updatedAt) {
		$this->updated_at = $updatedAt;

		return $this;
	}

	/**
	 * Get updated_at
	 *
	 * @return \DateTime 
	 */
	public function getUpdatedAt() {
		return $this->updated_at;
	}

	/**
	 * Set order
	 *
	 * @param \Application\ShoppingBundle\Entity\Order\Order $order
	 * @return Cart
	 */
	public function setOrder(
			\Application\ShoppingBundle\Entity\Order\Order $order = null) {
		$this->order = $order;

		return $this;
	}

	/**
	 * Get order
	 *
	 * @return \Application\ShoppingBundle\Entity\Order\Order 
	 */
	public function getOrder() {
		return $this->order;
	}

	/**
	 * Set user
	 *
	 * @param \Tabloz\UserBundle\Entity\User $user
	 * @return Cart
	 */
	public function setUser(\Tabloz\UserBundle\Entity\User $user = null) {
		$this->user = $user;

		return $this;
	}

	/**
	 * Get user
	 *
	 * @return \Tabloz\UserBundle\Entity\User 
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * Add items
	 *
	 * @param \Application\ShoppingBundle\Entity\Cart\CartItem $item
	 * @return Cart
	 */
	public function addItem(\Application\ShoppingBundle\Entity\Cart\CartItem $item) {
		if ($this->items){
			foreach ($this->items as $tmp_item){
				if ($tmp_item->equals($item)) {
					$tmp_item->incrementQuantity($item->getQuantity());
					return $this;
				}
			}
		}
		$item->setCart($this);
		$this->items[] = $item;

		return $this;
	}

	/**
	 * Remove items
	 *
	 * @param \Application\ShoppingBundle\Entity\Cart\CartItem $items
	 */
	public function removeItem(
			\Application\ShoppingBundle\Entity\Cart\CartItem $items) {
		$this->items->removeElement($items);
	}

	/**
	 * Get items
	 *
	 * @return \Doctrine\Common\Collections\Collection 
	 */
	public function getItems() {
		return $this->items;
	}
}