<?php
namespace Tabloz\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class TabloAdmin extends Admin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
		->with('General')
			->add('title')
			->add('description')
			->add('category')
			->add('user')
			->add('image', 'sonata_type_model_list', array(), array('link_parameters' => array('context' => 'tablo')))
			->add('curated', null, array('required' => false))
			->add('enable', null, array('required' => false))
		->end()
		;
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('title')
		->add('category')
		->add('curated')
		->add('user')
		->add('enable')
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('title')
		->add('category')
		->add('user')
		->add('curated')
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