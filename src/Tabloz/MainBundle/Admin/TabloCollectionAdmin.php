<?php
namespace Tabloz\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class TabloCollectionAdmin extends Admin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
		->with('General')
			->add('title')
			->add('user')
			->add('description')
			->add('private', null, array('required' => false))
			->add('enable', null, array('required' => false))
		->end()
		;
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('title')
			->add('user')
		->add('private')
		->add('enable')
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('title')
		->add('user')
		->add('private')
		->add('enable')
		;
	}

	public function validate(ErrorElement $errorElement, $object)
	{
// 		$errorElement
// 		->with('title')
// 		->assertLength(array('max' => 255))
// 		->end()
// 		;
	}
}