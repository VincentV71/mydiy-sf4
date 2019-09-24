<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RecetteTotalValidator extends ConstraintValidator
{
    /**
     * Validate the integrity of the quantities for a 'recette' (Total = base + arome)
     *
     * @param [type] $recette
     * @param Constraint $constraint
     * @return void
     */
    public function validate($recette, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\RecetteTotal */
        $qTot = $recette->getQteTot();
        $qBas = $recette->getQteBas();
        $qAro = $recette->getQteAro();

        if (null === $qTot || '' === $qTot
            || null === $qBas || '' === $qBas
            || null === $qAro || '' === $qAro) {
            return;
        }

        if ((float)($qTot) !== (float)($qBas) + (float)($qAro)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $qTot)
                ->atPath('qteTot')
                ->addViolation();
        }
    }
}
