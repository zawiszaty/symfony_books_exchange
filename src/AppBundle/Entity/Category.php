<?php

namespace AppBundle\Entity;

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

    public function changeName(string $name): void
    {
        $this->name = $name;
    }

    public function changeDescription(string $description): void
    {
        $this->description = $description;
    }

}

