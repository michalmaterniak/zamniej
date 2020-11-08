<?php
namespace App\EventListener\Validation;

use App\Entity\Interfaces\EntityInterface;
use App\EventListener\Validation\Exceptions\ValidatorException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidatorEntity
{
    /**
     * @var ValidatorInterface $validator
     */
    protected $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(EntityInterface $entity)
    {
        $errors = $this->validator->validate($entity);

        if ($errors->count() > 0) {
            /**
             * @var ConstraintViolation[] $errors
             */
            foreach ($errors as $error) {
                throw new ValidatorException($error->getMessage());
            }
        }
    }
}
