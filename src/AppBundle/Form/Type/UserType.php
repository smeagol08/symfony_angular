<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;  
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
 
class UserType extends AbstractType  
{      
public function buildForm(FormBuilderInterface $builder, array $options)     {                 
         $builder
             ->add('username', TextType::class)
             ->add('plainPassword', PasswordType::class);
    }
 
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
            'csrf_protection'   => false
        ));
    }
 
 
	public function getBlockPrefix()
	{
		return '';
	}
	    
}