<?php
namespace Application\ShoppingBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class PaymentAdmin extends Admin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
		->with('General')
			->add('amount', null, array('label' => 'مبلغ', 'disabled' => true))
			->add('order', null, array('label' => 'کد سفارش', 'disabled' => true))
			->add('verified', null, array('label' => 'تایید شده', 'disabled' => true))
			->add('created_at', null, array('label' => 'زمان ثبت پرداخت', 'disabled' => true))
			->add('updated_at', null, array('label' => 'زمان به روز رسانی پرداخت', 'disabled' => true))
		->end()
		;
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('amount', null, array('label' => 'مبلغ'))
		->add('order', null, array('label' => 'کد سفارش'))
		->add('verified', null, array('label' => 'تایید شده'))
		->add('created_at', null, array('label' => 'زمان ثبت پرداخت'))
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('amount', null, array('label' => 'مبلغ'))
		->add('order', null, array('label' => 'کد سفارش'))
		->add('verified', null, array('label' => 'تایید شده'))
		->add('created_at', null, array('label' => 'زمان ثبت پرداخت', 'template' => 'FactoryUtilityBundle:CRUD:list_datetime.html.twig'))
		->add('updated_at', null, array('label' => 'زمان به روز رسانی پرداخت', 'template' => 'FactoryUtilityBundle:CRUD:list_datetime.html.twig'))
		;
	}

	public function configureRoutes(RouteCollection $collection)
	{
		$collection->remove('create');
		$collection->remove('delete');
	}
}