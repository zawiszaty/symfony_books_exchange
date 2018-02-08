<?php
/**
 * Created by PhpStorm.
 * User: zawisza
 * Date: 06.02.2018
 * Time: 07:45
 */

namespace AppBundle\Category\Command;

use AppBundle\Validator\Constraint\ExistingField\ExistingField;
use AppBundle\Validator\Constraint\UniqueField\UniqueField;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class EditCategoryCommand
 * @package AppBundle\Command
 */
final class EditCategoryCommand
{

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @ExistingField(entityClass="AppBundle\Entity\Category", field="idCategory")
     */
    public $idCategory;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    public $name;

    /**
     * @var string
     *
     * @Assert\Type("string")
     */
    public $description;

    /**
     * EditCategoryCommand constructor.
     *
     * @param string $id
     * @param string $name
     * @param string $description
     */
    public function __construct(
        string $id,
        string $name,
        string $description
    )
    {
        $this->idCategory = $id;
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getIdCategory(): string
    {
        return $this->idCategory;
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