<?php
namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class StartsWithCapitalValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if($value==null)
        {

        }
        else
        {
            if (!preg_match('/^[A-Z]/', $value)) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ string }}', $value)
                    ->addViolation();
            }
        }
       
    }
}
