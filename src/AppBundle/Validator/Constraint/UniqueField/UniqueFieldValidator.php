<?php


namespace AppBundle\Validator\Constraint\UniqueField;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class UniqueFieldValidator
 */
class UniqueFieldValidator extends ConstraintValidator
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * UniqueFieldValidator constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        $entityRepository = $this->entityManager
            ->getRepository($constraint->entityClass);

        if (!is_scalar($constraint->field)) {
            throw new \InvalidArgumentException(
                '"field" parameter should be any scalar type'
            );
        }
        $searchResults = $entityRepository->findBy(
            [$constraint->field => $value]
        );
        if (count($searchResults) > 0) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}