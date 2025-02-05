<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['data']->isnew()) {
            $builder->add('username', TextType::class, [
                'label' => 'Username',
                'required' => true,
            ]);
        } else {
            $builder->add('username', TextType::class, [
                'label' => 'Username',
                'disabled' => true,
            ]);
        }
        $builder->add('admin', CheckboxType::class, [
            'label' => 'Admin',
            //    'empty_data' => 0,
            'required' => false,
        ]);
        if ($options['data']->isnew()) {
            $builder->add('plaintext_password', PasswordType::class, [
                'label' => 'Password',
                'required' => true,
                'mapped' => false,
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
