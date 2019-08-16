<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class RecetteArome extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'La quantité d\'arôme "{{ value }}" ne correspond pas au dosage d\'arôme indiqué';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
