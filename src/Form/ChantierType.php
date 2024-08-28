<?php

namespace App\Form;

use App\Entity\Chantier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChantierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('desctription')
            ->add('cover', FileType::class, [
                'label' => 'Cover Image',
                'required' => false,
                'data_class' => null, // Add this line
            ])
            ->add('imgleft', FileType::class, [
                'label' => 'Left Image',
                'required' => false,
                'data_class' => null, // Add this line
            ])
            ->add('imgright', FileType::class, [
                'label' => 'Right Image',
                'required' => false,
                'data_class' => null, // Add this line
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chantier::class,
        ]);
    }
}
