<?php

namespace AppBundle\Category\Command;

use AppBundle\Validator\Constraint\ExistingField\ExistingField;
use Symfony\Component\Validator\Constraints as Assert;

final class DeleteCategoryCommand
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ExistingField(entityClass="AppBundle\Entity\Category", field="idCategory")
     *
     */
    public $idCategory;

    /**
     * DeleteCategoryCommand constructor.
     *
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->idCategory = $id;
    }

    /**
     * @return string
     */
    public function getIdCategory(): string
    {
        return $this->idCategory;
    }

}