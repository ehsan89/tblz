<?php
namespace Tabloz\UserBundle\DataFixtures\ORM;

use Tabloz\UserBundle\Entity\CreditPayoffRequestStatus;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Tabloz\UserBundle\Entity\User;

class LoadCreditPayoffRequestStatusData implements FixtureInterface {
	/**
	 * {@inheritDoc}
	 */
	public function load(ObjectManager $manager) {

		$status = new CreditPayoffRequestStatus();
		$status->setTitle('در حال انتظار');
		$status->setDescriptor('pending');
		$manager->persist($status);

		$status = new CreditPayoffRequestStatus();
		$status->setTitle('انجام شده');
		$status->setDescriptor('completed');
		$manager->persist($status);

		$status = new CreditPayoffRequestStatus();
		$status->setTitle('کنسل شده');
		$status->setDescriptor('canceled');
		$manager->persist($status);

		$manager->flush();
	}
}
