<?php
namespace Application\ShoppingBundle\Twig;

use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ShoppingExtension extends \Twig_Extension {

	protected $doctrine;
	protected $container;

	public function __construct(RegistryInterface $doctrine, ContainerInterface $container)
	{
		$this->container = $container;
		$this->doctrine = $doctrine;
	}

	public function getFunctions() {
		return array(
				'cart_items_count' => new \Twig_Function_Method($this, 'cartItemsCount'));
	}

	/**
	 * Prints the number of items in the cart
	 */
	public function cartItemsCount() {
		$cart_repo = $this->doctrine->getRepository('ApplicationShoppingBundle:Cart\Cart');
		$session = $this->container->get('session');
		$cart_id = $session->get('cart_id');
		$cart = $cart_repo->getCartById($cart_id);
		if ($cart) {
			return $cart->getTotalCount();
		}
		return 0;
	}

	public function getName() {
		return 'shopping_extension';
	}
}
