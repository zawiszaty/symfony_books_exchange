<?php

namespace AppBundle\Category\Command;

use AppBundle\Entity\Category;
use AppBundle\Validator\Constraint\UniqueField\UniqueField;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CategoryCommand
 *
 * @package AppBundle\Command
 */
final class AddCategoryCommand
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @UniqueField(entityClass="AppBundle\Entity\Category", field="name")
     */
    public $name;

    /**
     * @var string
     *
     * @Assert\Type("string")
     */
    public $description;

    public function __construct(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

}