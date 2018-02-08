<?php

namespace AppBundle\Category\Query;

/**
 * Interface CategoryQueryInterface
 * @package AppBundle\Query\Category
 */
interface CategoryQuery
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