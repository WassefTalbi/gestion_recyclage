<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * @Annotation
 */
class StartsWithCapital extends Constraint
{
    public $message = 'The referance must start with a capital letter.';
}