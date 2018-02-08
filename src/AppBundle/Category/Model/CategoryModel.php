<?php

namespace AppBundle\Category\Model;

/**
 * Class CategoryView
 *
 * @package AppBundle\View\Category
 */
final class CategoryModel
{
    /**
     * @var string
     */
    private $idCategory;

    /**
     * @var string
     */
    private $name;

    /**
     * @var
     */
    private $description;

    /**
     * CategoryView constructor.
     * @param string $idCategory
     * @param string $name
     * @param $description
     */
    public function __construct(string $idCategory, string $name, $description)
    {
        $this->idCategory = $idCategory;
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
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

}