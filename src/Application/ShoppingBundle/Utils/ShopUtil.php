<?php

namespace Application\ShoppingBundle\Utils;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ShopUtil {

	public static $shop_email = 'shop@tabloz.com';
	public static $shop_technical_support_email = 'ehsan89@gmail.com';

	public static $vat_percent = 6;
	
	public static $verification_success_code_name = 1;
	
	
	/**
	 * Verifies the transaction and returns the result
	 *
	 * @author Ehsan Razzazi
	 *
	 * @param int $refrence_number
	 * @param Account $account
	 *
	 * @return int verification result
	 */
	public static function verifyTransaction($refrence_number, $account){
		$client = new SoapClient($account->getWspLink());
		$result = 0;
		for ($i=0;$i<5;$i++) {
			$result = $client->verifyTransaction($refrence_number, $account->getMerchantId());
			if ($result != 0)
				return $result;
		}
		return $result;
	}

	/**
	 * Refunds the transaction with the specified reference number and returns the result
	 *
	 * @author Ehsan Razzazi
	 *
	 * @param int $refrence_number
	 * @param Account $account
	 * @param int $amount
	 *
	 * @return int reverse transaction result
	 */
	public static function webRefund($refrence_number, $account, $amount){
		$client = new SoapClient($account->getWspLink());
		$result = 0;
		for ($i=0;$i<5;$i++) {
			$result = $client->reverseTransaction ($refrence_number, $account->getMerchantId(), $account->getMerchantPassword(), doubleval($amount));
			if ($result != 0)
			return $result;
		}
		return $result;
	}
}