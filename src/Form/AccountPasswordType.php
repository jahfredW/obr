<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'disabled' => true
            ])
            ->add('old_password', PasswordType::class, [
                'mapped' => false,
                'label' => 'Mot de passe actuel',
                'attr' => [
                    'placeholder' => 'Veuillez entrer votre mot de passe actuel'
                ]
            ])
            ->add('new_password', RepeatedType::class,[
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Les mots de passe ne correspondent pas',
                'label' => 'Nouveau Mot de Passe',
                'required' => true,
                'first_options' => ['label' => 'Nouveau mot de passe', 'attr' => [
                    'placeholder' => 'Entrez votre nouveau  mot de passe'
                ]],
                'second_options' => ['label' => 'Confirmez votre mot de pass', 'attr' => [
                    'placeholder' => 'Confirmation du nouveau du mot de passe'
                ]
                ]
            ])
            ->add('submit', SubmitType::class , [
                'label' => "Soumettre"
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'method' => 'POST'
        ]);
    }
}
