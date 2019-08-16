<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class RecetteSteep extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'La date de fin de steep "{{ value }}" ne correspond pas au nombre de jours de steep conseillés pour cet arôme';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
