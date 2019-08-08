<?php

namespace App\Form;

use App\Entity\Arome;
use App\Entity\AromeRecette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class AromeRecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dosAro', NumberType::class, [
                'invalid_message' => 'Le dosage de votre arôme doit correspondre à une valeur numérique',
                'error_bubbling' => true
                ])
            ->add('idRecet')
            ->add(
                'idAro',
                EntityType::class,
                [
                'class' => Arome::class,
                'choice_label' => 'nomAro'
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AromeRecette::class,
        ]);
    }
}
