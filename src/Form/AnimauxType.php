<?php

namespace App\Form;

use App\Entity\Zoo;
use App\Entity\Animaux;
use App\Entity\Familles;
use App\Entity\Continents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AnimauxType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom : ',
                'required' => true,
            ])
            ->add('dangereux', ChoiceType::class, [
                'label' => 'Dangereux : ',
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
                'expanded' => true,
                'multiple' => false,
            ])
            ->add('images', FileType::class, [
                'label' => 'Choisir une image :',
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide.',
                    ])
                ],
                'mapped' => false,
                'required' => true,
            ])
            ->add('famille', EntityType::class, [
                'class' => Familles::class,
                'label' => 'Famille : ',
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionnez une famille',
                'required' => true,
            ])
            ->add('continent', EntityType::class, [
                'class' => Continents::class,
                'label' => 'Continent : ',
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionnez un continent',
                'required' => true,
            ])
            ->add('zoo', EntityType::class, [
                'class' => Zoo::class,
                'label' => 'Zoo : ',
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionnez un zoo',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animaux::class,
        ]);
    }
}
