<?php
namespace Factory\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

class BlogPostRepository extends EntityRepository {
	
	public function getPosts($limit = 0, $offset = 0) {
		return $this->createQueryBuilder('p')
		->where('p.enable = 1')
		->orderBy('p.created_at', 'DESC')
		->setFirstResult( $offset )
		->setMaxResults( $limit )
    	->getQuery()
    	->getResult();
	}
	
	public function getPopularPosts($limit = 0, $offset = 0) {
		return $this->createQueryBuilder('p')
		->where('p.enable = 1')
		->orderBy('p.view_count', 'DESC')
		->addOrderBy('p.created_at', 'DESC')
		->setFirstResult( $offset )
		->setMaxResults( $limit )
    	->getQuery()
    	->getResult();
	}	
}
