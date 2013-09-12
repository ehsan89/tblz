<?php
namespace Tabloz\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class TabloTellFriendType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
				->add('from_name', 'text',
						array(	'label' => 'نام',
								'required' => false,
								'attr' => array(
										'placeholder' => 'نام شما')))
				->add('from_email', 'email',
						array(	'label' => 'ایمیل شما',
								'required' => false,
								'attr' => array(
										'placeholder' => 'you@example.com')))
				->add('to_email', 'email',
						array(	'label' => 'ایمیل دریافت کننده',
								'attr' => array(
										'placeholder' => 'friend@example.com')))
				->add('message', 'textarea',
						array(	'label' => 'پیام',
								'required' => false,
								'attr' => array(
										'placeholder' => 'متن پیام شما...')));
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'Tabloz\MainBundle\Entity\TabloTellFriend',
		));
	}

	public function getName()
	{
		return 'tablo_tell_friend';
	}
}