<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RecetteAromeValidator extends ConstraintValidator
{
    /**
     * Validate the integrity of the values "dosAro" and "qteAro"
     *
     * @param [type] $recette
     * @param Constraint $constraint
     * @return void
     */
    public function validate($recette, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\RecetteArome */
        $aroQte = $recette->getQteAro();
        $totQte = $recette->getQteTot();
        $aroDos = $recette->getAromeRecettes()
                            ->get(0)
                            ->getDosAro();

        if (null === $aroQte || '' === $aroQte
            || null === $totQte || '' === $totQte
            || null === $aroDos || '' === $aroDos) {
            return;
        }

        if ($aroQte != round($totQte*($aroDos/100), 1)) {
            $this->context->buildViolation($constraint->message)
                        ->setParameter('{{ value }}', $aroQte)
                        ->atPath('qteAro')
                        ->addViolation();
        }
    }
}
