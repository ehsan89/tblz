<?php
namespace Application\ShoppingBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;


class CheckoutType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		
		$builder
				->add('name', 'text',
						array(	'label' => 'نام',
								'required' => true,
								'attr' => array(
										'placeholder' => 'نام')))
				->add('email', 'email',
						array(	'label' => 'ایمیل',
								'required' => true,
								'attr' => array(
										'placeholder' => 'you@example.com')))
				->add('phone', 'text',
						array(	'label' => 'شماره تماس',
								'required' => true,
								'attr' => array(
										'placeholder' => '091211111111')))
				/*->add('country', null,
						array(	'label' => 'کشور'))
				->add('state', null,
						array(	'label' => 'استان'))
				->add('city', 'text',
						array(	'label' => 'شهر',
								'attr' => array(
										'placeholder' => 'شهر')))
				->add('address', 'textarea',
						array(	'label' => 'آدرس',
								'required' => false,
								'attr' => array(
										'placeholder' => 'آدرس محل دریافت سفارش...')))
				->add('postal_code', 'text',
						array(	'label' => 'کد پستی',
								'attr' => array(
										'placeholder' => 'کد پستی محل دریافت سفارش')))*/
				->add('account', 'entity', 
						array(	'label' => 'درگاه',
								'expanded' => true,
								'class' => 'ApplicationShoppingBundle:Payment\Account',
								'query_builder' => function(EntityRepository $er) {
									return $er->createQueryBuilder('a')
									->where('a.enable = 1');
								},))
				->add('save', 'submit', 
						array(	'label' => 'پرداخت' ))
		;
	}
	
	public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'Application\ShoppingBundle\Entity\Order\Order',
		));
	}

	public function getName()
	{
		return 'checkout';
	}
}