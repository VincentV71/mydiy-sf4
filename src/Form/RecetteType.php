<?php

namespace App\Form;

use App\Entity\Base;
use App\Entity\Recette;
use App\Form\AromeRecetteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datRecet', DateType::class, [
                'widget' => 'text'
                ])
            ->add('qteAro', NumberType::class, [
                'invalid_message' => 'La quantité d\'arôme de la recette n\'est pas une valeur numérique.'
                ])
            ->add('qteBas', NumberType::class, [
                'invalid_message' => 'La quantité de base de la recette n\'est pas une valeur numérique.'
                ])
            ->add('qteTot', IntegerType::class, [
                'invalid_message' => 'La quantité totale de la recette n\'est pas un nombre entier.'
                ])
            ->add('datStee', DateType::class, [
                'widget' => 'text'
                ])
            ->add('etaStee', ChoiceType::class, [
                'choices' => [
                    'STEEP' => 'STEEP',
                    'PRETE' => 'PRETE',
                    'FINIE' => 'FINIE'
                ]
            ])
            ->add('comMember', TextareaType::class, ['attr' => [
                'placeholder' => 'Saisissez un nouveau commentaire (70 caractères maximum)'
                ]
            ])
            ->add('affRecet', ChoiceType::class, [
                'choices' => [
                    'oui' => 'oui',
                    'non' => 'non'
                ]
            ])
            ->add('etoiles', ChoiceType::class, [
                'choices' => [
                    '0' => 0,
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5
                ]
            ])
            ->add('idMember')
            ->add(
                'idBase',
                EntityType::class,
                [
                'class' => Base::class
                ]
            )
            ->add('aromeRecettes', CollectionType::class, [
                // each entry in the array will be an "AromeRecette" field
                // (dosAro, idAro and idRecet)
                'entry_type' => AromeRecetteType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'prototype' => true,
                'by_reference' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recette::class
        ]);
    }
}
