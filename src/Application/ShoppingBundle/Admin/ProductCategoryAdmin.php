<?php
namespace Application\ShoppingBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class ProductCategoryAdmin extends Admin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
		->with('General')
			->add('title')
			->add('descriptor')
			->add('description')
			->add('enable', null, array('required' => false))
		->end()
		;
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('title')
		->add('descriptor')
		->add('description')
		->add('enable')
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('title')
		->add('descriptor')
		->add('description')
		->add('enable')
		;
	}

	public function validate(ErrorElement $errorElement, $object)
	{
		$errorElement
		->with('title')
		->assertLength(array('max' => 255))
		->end()
		;
	}
}