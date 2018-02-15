<?php


namespace AppBundle\Book\Query;


/**
 * Interface BookQuery
 * @package AppBundle\Book\Query
 */
interface BookQuery
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