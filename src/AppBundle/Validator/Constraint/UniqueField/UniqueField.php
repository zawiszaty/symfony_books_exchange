<?php


namespace AppBundle\Validator\Constraint\UniqueField;


use Symfony\Component\Validator\Constraint;


/**
 * Class UniqueField
 *
 * @package AppBundle\Validator\Constraint\UniqueField
 *
 * @Annotation
 */
class UniqueField extends Constraint
{
    /**
     * @var string
     */
    public $message = 'This value is already used.';
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