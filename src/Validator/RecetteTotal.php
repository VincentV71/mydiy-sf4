<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class RecetteTotal extends Constraint
{
    /*
     * Any public properties become valid options for the annotation.
     * Then, use these in your validator class.
     */
    public $message = 'La valeur "{{ value }}" ne correspond pas à la somme des quantités de base et d\'arôme';

    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
