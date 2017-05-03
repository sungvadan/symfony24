<?php

namespace Yoda\UserBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegisterFormType extends AbstractType
{
    public function getName()
    {
        return 'register_form';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username','text')
            ->add('email','email',array(
                'label' => 'Email Address'
            ))
            ->add('plainPassword','repeated',array(
                'type' => 'password'
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
           'data_class' => 'Yoda\UserBundle\Entity\User'
        ));
    }

}