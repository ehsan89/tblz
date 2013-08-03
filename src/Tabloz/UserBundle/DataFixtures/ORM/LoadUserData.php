<?php
namespace Tabloz\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Tabloz\UserBundle\Entity\User;

class LoadUserData implements FixtureInterface {
	/**
	 * {@inheritDoc}
	 */
	public function load(ObjectManager $manager) {

		$adminUser = new User();
		$adminUser->setUsername('admin');
		$adminUser->setPassword('=-0987654321`');
		$adminUser->setEmail('ehsan89@gmail.com');
		$adminUser->setSuperAdmin(true);
		$manager->persist($adminUser);

		$manager->flush();
	}
}
