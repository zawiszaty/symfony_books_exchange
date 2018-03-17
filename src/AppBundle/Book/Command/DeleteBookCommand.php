<?php


namespace AppBundle\Book\Command;

use AppBundle\Validator\Constraint\ExistingField\ExistingField;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class DeleteBookCommand
 * @package AppBundle\Book\Command
 */
final class DeleteBookCommand
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ExistingField(entityClass="AppBundle\Entity\Book", field="idCategory")
     *
     */
    public $idBook;

    /**
     * DeleteBookCommand constructor.
     *
     * @param string $idBook
     */
    public function __construct(string $idBook)
    {
        $this->idBook = $idBook;
    }

    /**
     * @return string
     */
    public function getIdBook(): string
    {
        return $this->idBook;
    }

}