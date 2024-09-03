<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'form-control form-control-lg', 'placeholder' => 'Nom'],
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone',
                'attr' => ['class' => 'form-control form-control-lg', 'placeholder' => 'Téléphone'],
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'attr' => ['class' => 'form-control form-control-lg', 'placeholder' => 'Ville'],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => ['class' => 'thm-btn appointment__btn w-100'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null, // Changez ceci si vous utilisez une entité
        ]);
    }
}
