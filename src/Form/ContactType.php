<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nature de la demande', 
                'attr' => [
                    'placeholder' => "Type de panne"
                ]
            ])
            ->add('description', TextareaType::class, [
                "label" => 'Description',
                "attr" => [
                    "placeholder" => "Expliquez votre souci en quelques mots"
                ]
            ])
            ->add('name', TextType::class, [
                "label" => 'Votre nom',
                'attr' => [
                    "placeholder" => "Entrez votre nom"
                ]
            ])
            ->add('email', EmailType::class, [
                "label" => 'Votre Email',
                'attr' => [
                    "placeholder" => "Entrez votre email"
                ]
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Votre téléphone',
                'attr' => [
                    "placeholder" => "Entrez votre téléphone"
                ]
            ])
            // ->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
            //     dump($event->getData());
            //     dump($event->getForm());
            // })
            ->add('submit', SubmitType::class, [
                'label' => "Soumettre"
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
