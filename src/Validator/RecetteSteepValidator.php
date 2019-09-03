<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RecetteSteepValidator extends ConstraintValidator
{
    /**
     * Validate that the Steepdate of a 'recette' is equal to :
     * the date of creation of the 'recette' + number of steeping days related to the selected 'arome'
     *
     * @param [type] $recette
     * @param Constraint $constraint
     * @return void
     */
    public function validate($recette, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\RecetteSteep */
        $datRecette = $recette->getDatRecet();
        $nbJoursSteep = $recette->getAromeRecettes()
                                ->get(0)
                                ->getIdAro()
                                ->getNbJStee();
        $datSteep = $recette->getDatStee();

        if (null === $datRecette || '' === $datRecette
            || null === $nbJoursSteep || '' === $nbJoursSteep
            || null === $datSteep || '' === $datSteep) {
            return;
        }

        if ($datSteep != ($datRecette->modify('+'.$nbJoursSteep.' day'))) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $datSteep->format('d-m-Y'))
                ->atPath('datSteep')
                ->addViolation();
        }
        $datRecette->modify('-'.$nbJoursSteep.' day');
    }
}
