<?php
namespace Tabloz\UserBundle\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository {
	
	/*public function getLatestTablos($limit = 0, $offset = 0) {
		return $this->createQueryBuilder('t')
		->where('t.enable = 1')
		->andWhere('t.private = 0')
		->orderBy('t.published_at', 'DESC')
		->setFirstResult( $offset )
		->setMaxResults( $limit )
    	->getQuery()
    	->getResult();
	}
	
	public function getPopularTablos($limit = 0, $offset = 0) {
		return $this->createQueryBuilder('t')
		->where('t.enable = 1')
		->andWhere('t.private = 0')
		->orderBy('t.favorite_count', 'DESC')
		->addOrderBy('t.view_count', 'DESC')
		->setFirstResult( $offset )
		->setMaxResults( $limit )
		->getQuery()
		->getResult();
	}
	
	public function getPopularWeekTablos($limit = 0, $offset = 0) {
		$last_week = date('Y-m-d H:i:s', strtotime('-1 week'));
		return $this->createQueryBuilder('t')
		->where('t.enable = 1')
		->andWhere('t.private = 0')
		->andWhere('t.published_at >= :last_week')->setParameter('last_week', $last_week)
		->addOrderBy('t.favorite_count', 'DESC')
		->addOrderBy('t.view_count', 'DESC')
		->setFirstResult( $offset )
		->setMaxResults( $limit )
		->getQuery()
		->getResult();
	}
	
	public function getLatestPopularTablos($limit = 0, $offset = 0) {
		return $this->createQueryBuilder('t')
		->where('t.enable = 1')
		->andWhere('t.private = 0')
		->orderBy('t.published_at', 'DESC')
		->addOrderBy('t.favorite_count', 'DESC')
		->addOrderBy('t.view_count', 'DESC')
		->setFirstResult( $offset )
		->setMaxResults( $limit )
		->getQuery()
		->getResult();
	}
	
	public function getTablos($category_descriptor = 'all', $order = 'latest', $limit = 0, $offset = 0) {
		$query = $this->createQueryBuilder('t');
		$query->where('t.enable = 1')
		->andWhere('t.private = 0');
		if ($category_descriptor != 'all'){
			$query->innerJoin('t.category', 'tc', 'WITH', 'tc.descriptor = :descriptor')->setParameter('descriptor', $category_descriptor);
		}
		if ($order == 'latest'){
			$query->orderBy('t.published_at', 'DESC');
		} elseif ($order == 'popular_all_time') {
			$query->orderBy('t.favorite_count', 'DESC')
			->addOrderBy('t.view_count', 'DESC');
		} elseif ($order == 'latest_popular') {
			$query->orderBy('t.published_at', 'DESC')
			->addOrderBy('t.favorite_count', 'DESC')
			->addOrderBy('t.view_count', 'DESC');
		}
		$query->setFirstResult( $offset )
		->setMaxResults( $limit );
		return $query->getQuery()->getResult();
	}*/
	
	function search($text, $order = 'latest', $limit = 0, $offset = 0){
		$search_fields = array('firstname', 'lastname');
		$criteria = array();
		foreach($search_fields as $field){
			if( isset( $this->_class->fieldNames[$field] ) && !empty($text) ){
				$criteria[$field] = explode(' ', $text);
			}
		}
		if(empty($criteria)){
			return null;
		}
		$alias = "t";
		$query = $this->createQueryBuilder($alias);
		//andx is used to build a WHERE clause like (expression 1 AND expression 2)
		//Alternatively you can use orx for (expression 1 OR expression 2)
		//Also you can next either inside of each other...so ->where(andx(orx("expression1","expression2),"expression3"))
		//would be WHERE ( ( expression 1 OR expression 2 ) AND expression 3  )
		$or = $query->expr()->orx();
		/**
		 *@note Example of programmatic Doctrine2 Like expression
		*/
		foreach($criteria as $key => $arr){
			foreach ($arr as $value){
				$or->add($query->expr()->like("{$alias}.{$key}", ":{$key}" ));
				$query->setParameter($key, "%{$value}%");
			}
		}
		$query->where($or)->andWhere('t.enabled = 1');
// 		if ($order == 'latest'){
			$query->orderBy('t.createdAt', 'DESC');
// 		} elseif ($order == 'popular_all_time') {
// 			$query->orderBy('t.favorite_count', 'DESC')
// 			->addOrderBy('t.view_count', 'DESC');
// 		} elseif ($order == 'latest_popular') {
// 			$query->orderBy('t.created_at', 'DESC')
// 			->addOrderBy('t.favorite_count', 'DESC')
// 			->addOrderBy('t.view_count', 'DESC');
// 		}
		$query->setFirstResult( $offset )
		->setMaxResults( $limit );
		return $query->getQuery()->getResult();
	}
	
}
