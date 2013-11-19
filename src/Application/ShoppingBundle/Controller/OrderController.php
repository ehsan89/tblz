<?php

namespace Application\ShoppingBundle\Controller;

use Application\ShoppingBundle\Entity\Order\Order;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class OrderController extends Controller
{
	
	/**
	 * @Route("/track_order", name="track_order")
	 * @Template()
	 */
	public function trackOrderAction(Request $request) {
		$order = null;
		$form = $this->createFormBuilder()
            ->add('order_code', 'text')
            ->add('search', 'submit', array('label' => 'بگرد'))
            ->getForm();

		$form->handleRequest($request);
		
		if ($form->isValid()) {
			$order_code = $form->get('order_code')->getData();
			$order_repo = $this->getDoctrine()->getRepository('ApplicationShoppingBundle:Order\Order');
			$order = $order_repo->findOneByCode($order_code);
			
			if (!$order){
				$this->get('session')->getFlashBag()->add(
						'notice',
						'سفارشی با این کد ثبت نشده است.'
				);
			}
		}
		
		return array('order' => $order, 'form' => $form->createView());
	}

}
