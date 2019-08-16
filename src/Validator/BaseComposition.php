<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class BaseComposition extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'La somme PG + VG doit être égale à 100.';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
