<?php

namespace App\Form;

use App\Entity\Arome;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AromeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomAro')
            ->add('fabAro')
            ->add('dosFab')
            ->add('nbJStee')
            ->add('catAro')
            ->add('affAro')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Arome::class,
        ]);
    }
}
