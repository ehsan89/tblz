<?php

namespace Tabloz\UserBundle\Controller;
use Tabloz\UserBundle\Entity\CreditPayoffRequest;

use Tabloz\MainBundle\Entity\TabloCollectionRepository;

use Tabloz\MainBundle\Entity\TabloCollection;

use Tabloz\UserBundle\Form\Type\TabloType;
use Tabloz\MainBundle\Entity\Tablo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Factory\UtilityBundle\Utils\Util;
use Imagine\Gd\Imagine;

/**
 * @Route("/user")
 */
class CreditController extends Controller {

	/**
	 * @Route("/manage_credit", name="manage_credit")
	 * @Template()
	 *
	 * @param Request $request
	 */
	public function manageCreditAction(Request $request) {
		$util = $this->container->get('util');
		$user = $util->getCurrentUser();

		$payoff_req = new CreditPayoffRequest();
		$form = $this->createFormBuilder($payoff_req)
		->add('debit_card_number')
		->add('bank_account_number')
		->add('description')
		->getForm();

		if ($request->isMethod('post')) {
			$form->handleRequest($request);
			if ($form->isValid()) {
				$payoff_req->setUser($user);
				$status = $this->getDoctrine()->getRepository('TablozUserBundle:CreditPayoffRequestStatus')->findOneByDescriptor('pending');
				$payoff_req->setStatus($status);
				$em = $this->getDoctrine()->getManager();
				$em->persist($payoff_req);
				$em->flush();
	
				return $this->render('TablozUserBundle:Credit:credit_payoff_request_row.html.twig', array('request' => $payoff_req));
			} else {
				return $this->render('TablozUserBundle:Credit:credit_payoff_request_dialog.html.twig', array('form' => $form));
			}
		}

		return array('form' => $form);
	}

	/**
	 * @Route("/cancel_credit_payoff_request", name="cancel_credit_payoff_request", requirements={"id" = "\d+"})
	 * @ParamConverter("payoff_request", class="TablozUserBundle:CreditPayoffRequest")
	 * @Template()
	 */
	public function cancelCreditPayoffRequestAction(CreditPayoffRequest $payoff_request) {
		$status = $this->getDoctrine()->getRepository('TablozUserBundle:CreditPayoffRequestStatus')->findOneByDescriptor('canceled');
		$payoff_request->setStatus($status);
		$em = $this->getDoctrine()->getManager();
		$em->persist($payoff_request);
		$em->flush();

		return new Response('success');
	}

}
