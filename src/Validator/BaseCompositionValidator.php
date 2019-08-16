<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class BaseCompositionValidator extends ConstraintValidator
{
    /**
     * Validate that PG + VG must be equal to 100% of a "base"
     *
     * @param [type] $base
     * @param Constraint $constraint
     * @return void
     */
    public function validate($base, Constraint $constraint)
    {
        /* @var $constraint \App\Validator\BaseComposition */

        if (null === $base->getPg() || '' === $base->getPg()
            || null === $base->getVg() || '' === $base->getVg()) {
            return;
        }

        if (100 !== $base->getPg() + $base->getVg()) {
            $this->context->buildViolation($constraint->message)
            // ->setParameter('{{ value }}', $base->getPg())
            ->atPath('dosPg')
            ->addViolation();
        }
    }
}
