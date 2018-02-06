<?php

namespace AppBundle\Entity;

use AppBundle\Command\AddCategoryCommand;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="archived", type="boolean", nullable=false)
     */
    private $archived = '0';

    /**
     * @var string
     * @ORM\Column(type="string")
     * @ORM\Id
     */
    private $idcategory;

    /**
     * Category constructor.
     *
     * @param string $name category name
     * @param string $description category description
     */
    public function __construct(string $name, string $description)
    {
        $this->idcategory = Uuid::uuid4();
        $this->name = $name;
        $this->description = $description;
    }

    /**
     * @param AddCategoryCommand $addCategoryCommand
     *
     * @return Category
     */
    public static function fromRegisterUserCommand(
        AddCategoryCommand $addCategoryCommand
    ): Category
    {
        return new self(
            $addCategoryCommand->name,
            $addCategoryCommand->description);
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

    /**
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->archived;
    }

    /**
     * @return string
     */
    public function getIdcategory(): string
    {
        return $this->idcategory;
    }

    /**
     * @param string $name
     */
    public function changeName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param string $description
     */
    public function changeDescription(string $description)
    {
        $this->description = $description;
    }


}

