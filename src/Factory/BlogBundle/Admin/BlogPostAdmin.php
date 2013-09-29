<?php
namespace Factory\BlogBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;

class BlogPostAdmin extends Admin
{
	protected function configureFormFields(FormMapper $formMapper)
	{
		$formMapper
		->with('General')
			->add('title')
			->add('abstract')
			->add('content', 'sonata_formatter_type', array(
		        'event_dispatcher' => $formMapper->getFormBuilder()->getEventDispatcher(),
		        'format_field'   => 'content_formatter',
		        'source_field'   => 'raw_content',
		        'source_field_options'      => array(
		            'attr' => array('class' => 'span10', 'rows' => 20)
		        ),
		        'target_field'   => 'content',
		        'listener'       => true,
		    ))
			->add('image', 'sonata_type_model_list', array(), array('link_parameters' => array('context' => 'blog_post')))
			->add('enable', null, array('required' => false))
		->end()
		;
	}

	protected function configureDatagridFilters(DatagridMapper $datagridMapper)
	{
		$datagridMapper
		->add('title')
		->add('user')
		->add('enable')
		;
	}

	protected function configureListFields(ListMapper $listMapper)
	{
		$listMapper
		->addIdentifier('title')
		->add('user')
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