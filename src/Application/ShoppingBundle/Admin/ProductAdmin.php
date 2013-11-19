<?php
namespace Application\ShoppingBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class ProductAdmin extends Admin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
		->with('General')
			->add('title')
			->add('description')
			->add('category')
			->add('image', 'sonata_type_model_list', array('required' => false), array('link_parameters' => array('context' => 'product')))
			->add('unit_price')
			->add('stock_count')
			->add('enable', null, array('required' => false))
		->end()
		;
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('title')
		->add('category')
		->add('enable')
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('title')
		->add('category')
		->add('unit_price')
		->add('stock_count')
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