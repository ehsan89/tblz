<?php

namespace Application\ShoppingBundle\Model;

use Doctrine\Common\Collections\Collection;

/**
 * Any sellable item must implement this interface
 */
interface SellableInterface
{
	/**
	 * Returns the name of the item used in the cart view
	 */
	public function getSellableName();
	
	/**
	 * Returns the view of the item in the cart (object parameter will be passed to this template)
	 */
	public function getCartView();
	
	/**
	 * Check whether the item is in stock or not
	 */
	public function isInStock();
	
	/**
	 * Decrement the stock count of the item
	 */
	public function decrementStock($count);
}