<?php
namespace Application\ShoppingBundle\Admin;

use Factory\UtilityBundle\Utils\DateUtil;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class OrderAdmin extends Admin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
		->with('اطلاعات مشتری', array('description' => 'این قسمت اطلاعات تماس مشتری را نشان می دهد.'))
			->add('code', null, array('label' => 'کد سفارش', 'disabled' => true))
			->add('user', null, array('label' => 'کاربر', 'disabled' => true))
			->add('name', null, array('label' => 'نام', 'disabled' => true))
			->add('email', null, array('label' => 'ایمیل', 'disabled' => true))
			->add('phone', null, array('label' => 'شماره تماس', 'disabled' => true))
			->add('country', null, array('label' => 'کشور', 'disabled' => true))
			->add('state', null, array('label' => 'استان', 'disabled' => true))
			->add('city', null, array('label' => 'شهر', 'disabled' => true))
			->add('address', null, array('label' => 'آدرس', 'disabled' => true))
			->add('postal_code', null, array('label' => 'کد پستی', 'disabled' => true))
			->add('paid', null, array('label' => 'پرداخت شده', 'disabled' => true))
			->add('status', null, array('label' => 'وضعیت سفارش'))
			//->add('enable', null, array('required' => false))
		->with('سبد خرید', array('description' => 'این قسمت اقلام سفارش داده شده و قیمت هریک را نشان می دهد.'))
			//->add('total', null, array('label' => 'قیمت محصولات', 'disabled' => true))
		->with('پرداخت ها', array('description' => 'این قسمت پرداخت های انجام شده برای این سفارش را نشان می دهد.'))
			->add('payments', 'sonata_type_collection', array(
				'label' => 'پرداخت ها',
                // Prevents the "Delete" option from being displayed
                'type_options' => array('delete' => false)
            ), array(
                'edit' => 'inline',
                'inline' => 'table',
                'sortable' => 'created_at',
            ))
		->end()
		;
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('code', null, array('label' => 'کد سفارش'))
		->add('user', null, array('label' => 'کاربر'))
		->add('name', null, array('label' => 'نام مشتری'))
		->add('paid', null, array('label' => 'پرداخت شده'))
		->add('status', null, array('label' => 'وضعیت سفارش'))
		//->add('created_at', null, array('label' => 'زمان ثبت'))
		->add('created_at_from', 'doctrine_orm_callback', array('label' => 'تاریخ ثبت (از)',
			'callback' => function($queryBuilder, $alias, $field, $value) {
				if (!$value['value']) return;
				$queryBuilder->andWhere($alias . '.created_at >= :from');
				$queryBuilder->setParameter('from', $value['value']->format('Y-m-d') . ' 00:00:00');
				return true;
			},
			'field_type' => 'jalali_date_picker'
		))
		->add('created_at_to', 'doctrine_orm_callback', array('label' => 'تاریخ ثبت (تا)',
			'callback' => function($queryBuilder, $alias, $field, $value) {
				if (!$value['value']) return;
				$queryBuilder->andWhere($alias . '.created_at <= :to');
				$queryBuilder->setParameter('to', $value['value']->format('Y-m-d') . ' 23:59:59');
				return true;
			},
			'field_type' => 'jalali_date_picker'
		))
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('code', null, array('label' => 'کد سفارش'))
		->add('name', null, array('label' => 'نام مشتری'))
		->add('paid', null, array('label' => 'پرداخت شده'))
		->add('status', null, array('label' => 'وضعیت سفارش'))
		//->add('enable', 'boolean', array('editable' => true))
		->add('created_at', null, array('label' => 'زمان ثبت', 'template' => 'FactoryUtilityBundle:CRUD:list_datetime.html.twig'))
		//->add('updated_at', null, array('label' => 'زمان به روز رسانی', 'template' => 'FactoryUtilityBundle:CRUD:list_datetime.html.twig'))
		;
	}
	
	public function configureRoutes(RouteCollection $collection)
	{
		$collection->remove('create');
	}
}