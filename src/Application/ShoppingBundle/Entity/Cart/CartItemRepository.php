<?php
namespace Application\ShoppingBundle\Entity\Cart;

use Application\ShoppingBundle\Entity\Tablo\TabloPrintItem;

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
	
	public function createTabloPrintItem($resource_id, $quantity, $properties = array()){
		$resource = $this->getEntityManager()
		->getRepository('TablozMainBundle:Tablo')->createQueryBuilder('t')
		->where('t.id = :id')->setParameter('id', $resource_id)
		->getQuery()
		->getSingleResult();
		$print_type = $this->getEntityManager()
		->getRepository('TablozMainBundle:PrintType')->createQueryBuilder('t')
		->where('t.id = :id')->setParameter('id', $properties['print_type_id'])
		->getQuery()
		->getSingleResult();
		$item = new TabloPrintItem();
		$item->setResource($resource);
		$item->setQuantity($quantity);
		$item->setPrintType($print_type);
		return $item;
	}
	
}