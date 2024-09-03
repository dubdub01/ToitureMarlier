<?php

namespace App\Form;

use App\Entity\Chantier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ChantierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un titre.',
                    ]),
                ],
                ]
                )
            ->add('description', TextareaType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une description.',
                    ]),
                ],
                ]
                )
                ->add('image', FileType::class, [
                    'label' => 'Cover Image',
                    'required' => true,
                    'data_class' => null, // Permet de gérer un champ de fichier non lié à une classe
                    'constraints' => [
                        new File([
                            'maxSize' => '4M', // Limite de taille à 4 Mo
                        ])
                    ],
                ])
                ->add('imageLeft', FileType::class, [
                    'label' => 'Image Gauche optionnel',
                    'required' => false,
                    'data_class' => null, // Permet de gérer un champ de fichier non lié à une classe
                    'constraints' => [
                        new File([
                            'maxSize' => '4M', // Limite de taille à 4 Mo
                        ])
                    ],
                ])
                ->add('imageRight', FileType::class, [
                    'label' => 'Image Droite optionnel',
                    'required' => false,
                    'data_class' => null, // Permet de gérer un champ de fichier non lié à une classe
                    'constraints' => [
                        new File([
                            'maxSize' => '4M', // Limite de taille à 4 Mo
                        ])
                    ],
                ])
                ;
        }
    
        public function configureOptions(OptionsResolver $resolver): void
        {
            $resolver->setDefaults([
                'data_class' => Chantier::class,
            ]);
        }
    }
