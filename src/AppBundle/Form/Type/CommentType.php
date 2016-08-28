<?php
namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class CommentType extends AbstractType
{
	
	public function buildForm(FormBuilderInterface $builder, array $options)     {
		$builder
		->add('content', TextType::class);
	}
	
	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(array(
				'data_class' => 'AppBundle\Entity\Comment',
				'csrf_protection'   => false
		));
	}
	
	public function getBlockPrefix()
	{
		return '';
	}
}