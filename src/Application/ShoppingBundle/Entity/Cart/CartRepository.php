<?php
namespace Application\ShoppingBundle\Entity\Cart;

use Doctrine\ORM\EntityRepository;

class CartRepository extends EntityRepository {
	
	public function getCartById($cart_id){
		if (!$cart_id) return null;
		$cart = $this->createQueryBuilder('c')
		->where('c.id = :id')->setParameter('id', $cart_id)
		->leftJoin('c.order', 'r')
		->having('COUNT(r) = 0')
		->getQuery()
		->getSingleResult();
		return $cart;
	}
	
}