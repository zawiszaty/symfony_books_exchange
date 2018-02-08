<?php

namespace AppBundle\Query\Category;

/**
 * Interface CategoryQueryInterface
 * @package AppBundle\Query\Category
 */
interface CategoryQueryInterface
{
    /**
     * @return array
     */
    public function getAll(): array;

    /**
     * @param string $id
     * @return mixed
     */
    public function getSingle(string $id);
}