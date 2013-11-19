<?php
namespace Application\ShoppingBundle\Entity\Cart;

use Application\ShoppingBundle\Entity\Product\ProductItem;

use Doctrine\ORM\EntityRepository;

class CartItemRepository extends EntityRepository {
	
	public function createProductItem($resource_id, $quantity, $properties = array()){
		$resource = $this->getEntityManager()
		->getRepository('ApplicationShoppingBundle:Product\Product')->createQueryBuilder('p')
		->where('p.id = :id')->setParameter('id', $resource_id)
		->getQuery()
		->getSingleResult();
		$item = new ProductItem();
		$item->setResource($resource);
		$item->setQuantity($quantity);
		return $item;
	}
	
}