<?php
namespace Application\ShoppingBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class AccountAdmin extends Admin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
		->with('General')
			->add('title', null, array('label' => 'عنوان'))
			->add('number', null, array('label' => 'شماره حساب'))
			->add('owner_name', null, array('label' => 'نام صاحب حساب'))
			->add('card_number', null, array('label' => 'شماره کارت'))
			->add('image', 'sonata_type_model_list', array('required' => false, 'label' => 'عکس'), array('link_parameters' => array('context' => 'account')))
			->add('enable', null, array('required' => false, 'label' => 'فعال'))
		->with('Web Payment')
			->add('merchant_id', null, array('label' => 'کد فروشنده'))
			->add('merchant_password', 'password', array('required' => false, 'label' => 'کلمه عبور فروشنده'))
			->add('link', null, array('label' => 'آدرس سایت صدور رسید دیجیتالی'))
			->add('wsp_link', null, array('label' => 'آدرس سایت ارائه دهنده سرویس'))
		->end()
		;
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('title')
		->add('number')
		->add('owner_name')
		->add('card_number')
		->add('merchant_id')
		->add('enable')
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('title')
		->add('number')
		->add('owner_name')
		->add('card_number')
		->add('enable', 'boolean', array('editable' => true))
		->add('created_at', null, array('template' => 'FactoryUtilityBundle:CRUD:list_datetime.html.twig'))
		->add('updated_at', null, array('template' => 'FactoryUtilityBundle:CRUD:list_datetime.html.twig'))
		;
	}

	public function validate(ErrorElement $errorElement, $object)
	{
		$errorElement
		->with('title')
		->assertLength(array('max' => 1000))
		->end()
		;
	}
}