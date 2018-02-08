<?php


namespace AppBundle\Category\QueryView;


use AppBundle\Category\Model\CategoryModel;
use AppBundle\Category\Query\CategoryQuery;
use Doctrine\DBAL\Connection;

class CategoryView implements CategoryQuery
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getAll(): array
    {
        $queryBuilder = $this->connection->createQueryBuilder()
            ->select('c.idCategory', 'c.name', 'c.description')
            ->from('category', 'c');

        $category = $this->connection->fetchAll(
            $queryBuilder->getSQL(),
            $queryBuilder->getParameters()
        );

        return array_map(
            function (array $category) {
                return new CategoryModel(
                    $category['idCategory'],
                    $category['name'],
                    $category['description']
                );
            }, $category);

    }

    public function getSingle(string $id)
    {
        $queryBuilder = $this->connection->createQueryBuilder()
            ->select('c.idCategory', 'c.name', 'c.description')
            ->from('category', 'c')
            ->where('c.idCategory = :id')
            ->setParameter('id', $id);

        $category = $this->connection->fetchAll(
            $queryBuilder->getSQL(),
            $queryBuilder->getParameters()
        );

        return new CategoryModel(
            $category[0]['idCategory'],
            $category[0]['name'],
            $category[0]['description']
        );
    }

}