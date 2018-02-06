<?php

namespace AppBundle\Provider;
use Doctrine\ORM\EntityManager;


/**
 * Class Provider
 *
 * @package AppBundle\Provider
 */
abstract class Provider
{
    /**
     * EntityManager $doctrine doctrine object
     *
     * @var EntityManager
     */
    protected $doctrine;

    /**
     * Provider constructor.
     *
     * @param EntityManager $doctrine doctrine object
     */
    public function __construct(EntityManager $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * Return all object
     *
     * @return array
     */
    public function getAll(): array
    {

    }

    /**
     * Return single object
     *
     * @param string $id object id
     *
     * @return object
     */
    public function getSingle(string $id): object
    {

    }
}