<?php
namespace Tabloz\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class TabloCommentType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('content', null, array('required' => false, 'attr' => array('placeholder' => 'نظر خود را بنویسید...')));
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'Tabloz\MainBundle\Entity\TabloComment',
		));
	}

	public function getName()
	{
		return 'tablo_comment';
	}
}