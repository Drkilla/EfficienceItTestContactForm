<?php

namespace App\Form;

use App\Entity\Departements;
use App\Entity\Contact;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>'Nom',
                'attr'=>[
                    'placeholder'=>'Veuillez entrer votre nom'
                ]
            ])
            ->add('prenom',TextType::class,[
                'label'=>'Prenom',
                'attr'=>[
                    'placeholder'=>'Veuillez entrer votre prenom',
                    'class'=>'form-control'
                ]
            ])
            ->add('mail',EmailType::class,[
                'label'=>'Adresse mail',
                'attr'=>[
                    'placeholder'=>'Veuillez entrer votre adresse mail',
                    'class'=>'form-control'
                ]
            ])
            ->add('message',TextareaType::class,[
                'label'=>'Message',
                'attr'=>[
                    'placeholder'=>'Votre message',
                    'class'=>'form-control'
                ]
            ])
            ->add('departement',EntityType::class,[
                'class'=>Departements::class,
                'choice_label'=>'nom',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('Envoyer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
