<?php

namespace Application\ShoppingBundle\Controller;


use Application\ShoppingBundle\Entity\Product\Product;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ProductController extends Controller
{

	/**
	 * @Route("/product/{id}", name="view_product", requirements={"id" = "\d+"})
     * @ParamConverter("product", class="ApplicationShoppingBundle:Product\Product")
	 * @Template()
	 */
	public function viewProductAction(Product $product) {
    	return array('product' => $product);
	}
}
