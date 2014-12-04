<?php
namespace UserBundle\Form\Type;

use Dragonfly\Model\User;
use FOS\UserBundle\Form\Type\RegistrationFormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Registration extends RegistrationFormType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', ['label' => 'your name'])
            ->add('email', 'email', ['label' => 'email address', 'error_bubbling' => false])
            ->add('phone_number', 'text', ['label' => 'phone number'])
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'first_options' => array('label' => 'password'),
                'second_options' => array('label' => 'confirm password'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(['data_class' => User::class]);
    }

    public function getName()
    {
        return 'user_registration';
    }
}