<?php

namespace App\Form;

use App\Entity\Base;
use App\Entity\Arome;
use App\Entity\Recette;
use App\Form\AromeType;
use App\Entity\AromeRecette;
use App\Form\AromeRecetteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RecetteOldType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datRecet')
            ->add('qteAro')
            // ->add('qteAro', TextareaType::class, ['attr' => ['label' => 'Quantité d`\arôme de la recette'] ])
            ->add('qteBas')
            ->add('qteTot', IntegerType::class)
            ->add('datStee')
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
            ->add('idBase')

            // ->add('aromeRecettes', EntityType::class, [
            //     'class' => AromeRecette::class,
            //     'choice_label' => 'dosAro'
            // ])

            // ---------Marche pour CREER UN NEW DIY (à tester !!!!)
            // ->add(
            //     'aromeRecettes',
            //     AromeRecetteType::class,
            //     array(
            //     'data_class' => null)
            // )
            
            // ---------Marche pour EDIT RECET
            ->add('aromeRecettes', CollectionType::class, [
                // each entry in the array will be an "AromeRecette" field
                // (dosAro, idAro and idRecet)
                'entry_type' => AromeRecetteType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true
            ])

            //     'aromeRecettes',
            //     AromeRecetteType::class,
            //     array(
            //     'data_class' => null)
            // )
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recette::class
        ]);
    }
}
