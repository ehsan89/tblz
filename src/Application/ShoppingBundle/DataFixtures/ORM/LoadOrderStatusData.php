<?php
namespace Application\ShoppingBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Application\ShoppingBundle\Entity\Order\OrderStatus;

class LoadOrderStatusData implements FixtureInterface {
	/**
	 * {@inheritDoc}
	 */
	public function load(ObjectManager $manager) {

		$stat = new OrderStatus();
		$stat->setTitle('در حال انتظار');
		$stat->setDescriptor('pending');
		$stat->setDescription('سفارش ثبت شده ولی هنوز بررسی نشده است.');
		$manager->persist($stat);

		$stat = new OrderStatus();
		$stat->setTitle('در دست بررسی');
		$stat->setDescriptor('in_progress');
		$stat->setDescription('سفارش ثبت شده و در دست بررسی است.');
		$manager->persist($stat);

		$stat = new OrderStatus();
		$stat->setTitle('آماده تحویل و یا ارسال');
		$stat->setDescriptor('ready');
		$stat->setDescription('سفارش بررسی شده و آماده تحویل و یا ارسال است.');
		$manager->persist($stat);

		$stat = new OrderStatus();
		$stat->setTitle('انجام شده');
		$stat->setDescriptor('completed');
		$stat->setDescription('سفارش تحویل داده شده است.');
		$manager->persist($stat);

		$stat = new OrderStatus();
		$stat->setTitle('کنسل شده');
		$stat->setDescriptor('canceled');
		$stat->setDescription('سفارش کنسل شده است.');
		$manager->persist($stat);

		$manager->flush();
	}
}
