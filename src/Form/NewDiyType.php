<?php

namespace App\Form;

use App\Entity\Recette;
use App\Entity\AromeRecette;
use App\Form\AromeRecetteType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class NewDiyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('datRecet')
            ->add('qteAro')
            // ->add('qteAro', TextareaType::class, ['attr' => ['label' => 'Quantité d`\arôme de la recette'] ])
            ->add('qteBas')
            ->add('qteTot')
            ->add('datStee')
            ->add('etaStee')
            ->add('comMember')
            ->add('affRecet')
            ->add('etoiles')
            ->add('idMember')
            ->add('idBase')
            ->add(
                'aromeRecettes',
                AromeRecetteType::class,
                array(
                'data_class' => null)
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recette::class
        ]);
    }
}
