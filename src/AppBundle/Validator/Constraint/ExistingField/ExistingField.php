<?php


namespace AppBundle\Validator\Constraint\ExistingField;


use Symfony\Component\Validator\Constraint;


/**
 * Class UniqueField
 *
 * @package AppBundle\Validator\Constraint\UniqueField
 *
 * @Annotation
 */
class ExistingField extends Constraint
{
    /**
     * @var string
     */
    public $message = 'Object not found';
    /**
     * @var string
     */
    public $entityClass;
    /**
     * @var string
     */
    public $field;
    /**
     * @return string[]
     */
    public function getRequiredOptions(): array
    {
        return ['entityClass', 'field'];
    }
    /**
     * @return string
     */
    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
    /**
     * @return string
     */
    public function validatedBy(): string
    {
        return get_class($this).'Validator';
    }
}