<?php
namespace Factory\BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class BlogPostCommentType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('content', null, array('required' => false, 'attr' => array('placeholder' => 'نظر خود را بنویسید...')));
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'Factory\BlogBundle\Entity\BlogPostComment',
		));
	}

	public function getName()
	{
		return 'blog_post_comment';
	}
}