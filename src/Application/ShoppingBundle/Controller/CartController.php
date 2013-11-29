<?php

namespace Application\ShoppingBundle\Controller;

use Application\ShoppingBundle\Entity\Order\Order;

use Application\ShoppingBundle\Utils\ShopUtil;

use Application\ShoppingBundle\Entity\Payment\WebPayment;

use Application\ShoppingBundle\Entity\Payment\Payment;

use Application\ShoppingBundle\Form\Type\CheckoutType;

use Application\ShoppingBundle\Entity\Cart\Cart;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CartController extends Controller
{
	/**
	 * @Route("/add_to_cart", name="add_to_cart")
	 * @Template()
	 */
	public function addToCartAction(Request $request) {
		$item_type = $request->query->get('type');
		$item_id = $request->query->get('id');
		$item_properties = $request->query->get('properties');
		$item_quantity = $request->query->get('quantity', 1);
		$cart_repo = $this->getDoctrine()->getRepository('ApplicationShoppingBundle:Cart\Cart');
		$cart_item_repo = $this->getDoctrine()->getRepository('ApplicationShoppingBundle:Cart\CartItem');
		
		$session = $this->getRequest()->getSession();
		$cart_id = $session->get('cart_id');
		$cart = $cart_repo->getCartById($cart_id);
		if (!$cart) {
			$cart = new Cart();
		}
		
		$util = $this->container->get('util');
		$user= $util->getCurrentUser();
		
		if ($util->isAuthenticated()){
			$cart->setUser($user);
		}
		
		$create_function = 'create'.$item_type.'Item';
		$cart_item = $cart_item_repo->$create_function($item_id, $item_quantity, $item_properties);
		$cart->addItem($cart_item);
		
		$em = $this->getDoctrine()->getManager();
		$em->persist($cart);
		$em->flush();
		
		$session->set('cart_id', $cart->getId());
		
		return $this->redirect($this->generateUrl('view_cart'));
		
    	//return array();

	}
	
	/**
	 * @Route("/delete_from_cart", name="delete_from_cart")
	 * @Template()
	 */
	public function deleteFromCartAction(Request $request) {
		$cart_item_id = $request->query->get('id');
		$cart_item_repo = $this->getDoctrine()->getRepository('ApplicationShoppingBundle:Cart\CartItem');
		$cart_repo = $this->getDoctrine()->getRepository('ApplicationShoppingBundle:Cart\Cart');
		$em = $this->getDoctrine()->getManager();
		
		$session = $this->getRequest()->getSession();
		$cart_id = $session->get('cart_id');
		$cart = $cart_repo->getCartById($cart_id);
		if (!$cart) {
			//throw $this->createNotFoundException('سبد خرید موجود نمی باشد.');
			return $this->redirect($this->generateUrl('view_cart'));
		}
				
		$cart_item = $cart_item_repo->find($cart_item_id);
		$em->remove($cart_item);
		$em->flush();
		
		return $this->redirect($this->generateUrl('view_cart'));
		
    	//return array();

	}
	
	/**
	 * @Route("/change_cart_item_quantity", name="change_cart_item_quantity")
	 * @Template("ApplicationShoppingBundle:Cart:viewCart.html.twig")
	 */
	public function changeCartItemQuantityAction(Request $request) {
		$cart_item_id = $request->query->get('id');
		$item_quantity = $request->query->get('quantity', 1);
		$cart_item_repo = $this->getDoctrine()->getRepository('ApplicationShoppingBundle:Cart\CartItem');
		$cart_repo = $this->getDoctrine()->getRepository('ApplicationShoppingBundle:Cart\Cart');
		$em = $this->getDoctrine()->getManager();
		
		$session = $this->getRequest()->getSession();
		$cart_id = $session->get('cart_id');
		$cart = $cart_repo->getCartById($cart_id);
		if (!$cart) {
			//throw $this->createNotFoundException('سبد خرید موجود نمی باشد.');
			return $this->redirect($this->generateUrl('view_cart'));
		}
				
		$cart_item = $cart_item_repo->find($cart_item_id);
		//only change the item quantity if the value is positive
		if ($item_quantity > 0){
			$cart_item->setQuantity($item_quantity);
			$em->persist($cart_item);
		}
		$em->flush();
		
		//return $this->redirect($this->generateUrl('view_cart'));
    	
		return array('cart' => $cart);

	}
	
	/**
	 * @Route("/view_cart", name="view_cart")
	 * @Template()
	 */
	public function viewCartAction() {
		$session = $this->getRequest()->getSession();
		$cart_id = $session->get('cart_id');
		$cart_repo = $this->getDoctrine()->getRepository('ApplicationShoppingBundle:Cart\Cart');
		$cart = $cart_repo->getCartById($cart_id);
		return array('cart' => $cart);
	}
	
	/**
	 * @Route("/empty_cart", name="empty_cart")
	 */
	public function emptyCartAction() {
		$session = $this->getRequest()->getSession();
		$cart_id = $session->get('cart_id');
		$cart_repo = $this->getDoctrine()->getRepository('ApplicationShoppingBundle:Cart\Cart');
		$cart = $cart_repo->getCartById($cart_id);
		$em = $this->getDoctrine()->getManager();
		$em->remove($cart);
		$em->flush();
		$session->remove('cart_id');
		
		return $this->redirect($this->generateUrl('view_cart'));
	}

	/**
	 * @Route("/checkout", name="checkout")
	 * @Template()
	 */
	public function checkoutAction(Request $request) {
		$session = $this->getRequest()->getSession();
		$cart_id = $session->get('cart_id');
		$cart_repo = $this->getDoctrine()->getRepository('ApplicationShoppingBundle:Cart\Cart');
		$cart = $cart_repo->getCartById($cart_id);
		if (!$cart){
			return $this->redirect($this->generateUrl('view_cart'));
		}
		$em = $this->getDoctrine()->getManager();

		$util = $this->container->get('util');
		$user= $util->getCurrentUser();

		$form = $this->createForm(new CheckoutType());


		if ($request->isMethod('POST')) {
			$form->bind($request);
		
			if ($form->isValid()) {
				// perform some action, such as saving the task to the database
				$order = new Order();
				$order = $form->getData();
				if ($util->isAuthenticated()){
					$order->setUser($user);
				}
				$order->setCart($cart);
				$order->setVatPercent($this->container->getParameter('vat_percent'));

				//Set the first status of the order to pending
				$stat_repo = $this->getDoctrine()->getRepository('ApplicationShoppingBundle:Order\OrderStatus');
				$status = $stat_repo->findOneByDescriptor('pending');
				$order->setStatus($status);
				
				$em->persist($order);
				$em->flush();

				$session = $this->getRequest()->getSession();
				$session->remove('cart_id');
				
				//web payment process
				$selected_account = $form['account']->getData();
				$redirect_url_name = 'RedirectURL';
				$order_code_name = 'ResNum';
				$merchant_id_name = 'MID';
				$amount_name = 'Amount';
				
				echo "<script type=\"text/javascript\">";
				echo "document.write(\"<form method=\\\"post\\\" name=\\\"account_redirect_form\\\" style=\\\"display: none;\\\" action=\\\"" . $selected_account->getLink()
				. "\\\"><input type=\\\"text\\\" value=\\\"" . $this->generateUrl('verify_transaction', array(), true) . "\\\" name=\\\"RedirectURL\\\"><input type=\\\"text\\\" value=\\\""
						. $order->getCode() . "\\\" name=\\\"ResNum\\\"><input type=\\\"text\\\" value=\\\""
								. $selected_account->getMerchantId() . "\\\" name=\\\"MID\\\"><input type=\\\"text\\\" value=\\\""
										. $order->getTotal() . "\\\" name=\\\"Amount\\\"><input type=\\\"submit\\\"></form>\");";
				echo "document.forms[\"account_redirect_form\"].submit();";
				echo "</script>";
				
			}
		}
		
		return array('form' => $form->createView(), 'cart' => $cart);
	}
	
	/**
	 * @Route("/verify_transaction", name="verify_transaction")
	 * @Template()
	 */
	public function verifyTransactionAction(Request $request) {
		$transaction_state_code_name = $request->request->get('State');
		$order_code = $request->request->get('ResNum');
		$reference_number = $request->request->get('RefNum');
		$em = $this->getDoctrine()->getManager();
		$with_error = false;
		
		try {
			$order_repo = $this->getDoctrine()->getRepository('ApplicationShoppingBundle:Order\Order');
			$order = $order_repo->findOneByCode($order_code);
			if (!$order) {
				throw $this->createNotFoundException('سفارش مورد نظر موجود نمی باشد.');
			}
			$account = $order->getAccount();
			if (!$account) {
				throw $this->createNotFoundException('حساب بانکی مورد نظر موجود نمی باشد.');
			}
			$trans_repo = $this->getDoctrine()->getRepository('ApplicationShoppingBundle:Payment\TransactionState');
			$transaction_state = $trans_repo->findOneBy(array('account' => $account, 'code_name' => $transaction_state_code_name));
			if (!$transaction_state) {
				throw $this->createNotFoundException('وضعیت پرداخت نامشخص است.');
			}
	
			$payment_repo = $this->getDoctrine()->getRepository('ApplicationShoppingBundle:Payment\Payment');
			$payment = $payment_repo->findOneByReferenceNumber($reference_number);
			if ($reference_number && $payment){
				return array('payment' => $payment);
			}
			
			$payment = new WebPayment();
			$payment->setAccount($account);
			$payment->setOrder($order);
			$payment->setTransactionState($transaction_state);
			$payment->setReferenceNumber($reference_number);
			if ($reference_number) {
				//$order->setReferenceNumber($reference_number);
				
				//verify the transaction
				$client = new SoapClient($account->getWspLink());
				$verify_status = ShopUtil::verifyTransaction($refrence_number, $account);
				$verify_status_obj = $trans_repo->findOneBy(array('account' => $account, 'code_name' => $verify_status));
				$payment->setVerificationState($verify_status_obj);
				
				// TODO: add 0 codename for no response in the database
			
				//try to refund if no answer was recieved after verification or the price paid is not correct
				if ($verify_status == 0 || ($verify_status > 0 && $verify_status != $order->getTotal())){
					$refund_status = ShopUtil::webRefund($refrence_number, $account, $order->getTotal());
					$refund = new WebRefund();
					$refund->setOrder($order);
					$refund->setAmount($order->getTotal());
					$refund->setReferenceNumber($reference_number);
					$refund->setVerificationState($trans_repo->findOneBy(array('account' => $account, 'code_name' => $refund_status)));
					$em->persist($refund);
				} //successful payment
				else if ($verify_status > 0 ) {
					$order->setPaid(true);
					$order->setPaidAt(date('Y-m-d H:i:s'));
					//if (!$order->getCreditOrder()) $order->setFactorNumber(OrdersTable::getNextFactorNumber(false));
					
					/*if ($order->getCreditOrder()){
						$user = $order->getUser();
						$order_price_type = $order->getPriceType();
						$user_credit = call_user_func(array($user, 'getCredit'.ucfirst($order_price_type->getDescriptor()))) ;
						call_user_func(array($user, 'setCredit'.ucfirst($order_price_type->getDescriptor())), $user_credit + $order->getPrice()) ;
						$user->save();
						if (Util::getCurrentUser_id()==$order->getUserId())
							Util::getCurrentSession()->setAttribute('credit', Util::getCurrentUser_credit() + $order->getPrice());
					}*/
			
				} //an error in verification has occured
				else if ($verify_status < 0){
				}
	
	
				//sending the corresponding emails
				if ($order->getEmail()) {
					$message = \Swift_Message::newInstance()
					->setFrom($this->container->getParameter('shop_email'))
					->setTo($order->getEmail());
					
					//TODO: send an email to admin too
					
					//no answer was recieved after verification or the price payed is not correct
					if ($verify_status == 0 || ($verify_status > 0 && $verify_status != $order->getTotal())){
						$message->setSubject('در عملیات پرداخت خطا رخ داده است')
						->setBody(
								$this->renderView(
										'ApplicationShoppingBundle:Cart:web_payment_mail_body.html.twig',
										array('payment' => $payment)
								)
						);
					} //successful payment
					else if ($verify_status > 0 ) {
						$message->setSubject('پرداخت با موفقیت انجام شد')
						->setBody(
								$this->renderView(
										'ApplicationShoppingBundle:Cart:web_payment_mail_body.html.twig',
										array('payment' => $payment)
								)
						);
					} //an error in verification has occured
					else if ($verify_status < 0){
						$message->setSubject('پرداخت ناموفق بوده است')
						->setBody(
								$this->renderView(
										'ApplicationShoppingBundle:Cart:web_payment_mail_body.html.twig',
										array('payment' => $payment)
								)
						);
					}
					$this->get('mailer')->send($message);
				}
			}
	
			//empty the cart
			$session = $this->getRequest()->getSession();
			$session->remove('cart_id');
	
			$em->persist($payment);
			$em->persist($order);
			$em->flush();
			
		} catch (\Exception $e){
			
			$with_error = true;
			
			$message = \Swift_Message::newInstance()
			->setFrom($this->container->getParameter('shop_email'))
			->setTo($this->container->getParameter('shop_technical_support_email'))
			->setSubject('Error In Payment Verification')
			->setBody($e.'');
			
		}
		
		return array('with_error' => $with_error, 'order' => $order, 'transaction_state' => $transaction_state);
	
	}
	
	
}
