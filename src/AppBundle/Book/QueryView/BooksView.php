<?php


namespace AppBundle\Book\QueryView;


use AppBundle\Book\Model\BookModel;
use AppBundle\Book\Query\BookQuery;
use AppBundle\Repository\CategoryRepository;
use Doctrine\DBAL\Connection;

/**
 * Class BooksView
 * @package AppBundle\Book\QueryView
 */
class BooksView implements BookQuery
{
    /**
     * @var Connection
     */
    private $connection;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * BooksView constructor.
     * @param Connection $connection
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(Connection $connection, CategoryRepository $categoryRepository)
    {
        $this->connection = $connection;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $queryBuilder = $this->connection->createQueryBuilder()
            ->select(
                'b.idBook',
                'b.name',
                'b.description',
                'b.address',
                'b.lat',
                'b.lng',
                'b.type',
                'b.category_idcategory'
            )
            ->from('book', 'b');
        $books = $this->connection->fetchAll(
            $queryBuilder->getSQL(),
            $queryBuilder->getParameters()
        );
        return array_map(
            function (array $books) {
                return new BookModel(
                    $books['idBook'],
                    $books['name'],
                    $books['description'],
                    $books['address'],
                    $books['lat'],
                    $books['lng'],
                    $books['type'],
                    $this->categoryRepository->find($books['category_idcategory'])
                );
            }, $books);
    }

    /**
     * @param string $id
     * @return BookModel
     */
    public function getSingle(string $id)
    {
        $queryBuilder = $this->connection->createQueryBuilder()
            ->select(
                'b.idBook',
                'b.name',
                'b.description',
                'b.address',
                'b.lat',
                'b.lng',
                'b.type',
                'b.category_idcategory'
            )
            ->from('book', 'b')
            ->where('b.idbook = :id')
            ->setParameter('id', $id);
        $books = $this->connection->fetchAll(
            $queryBuilder->getSQL(),
            $queryBuilder->getParameters()
        );

        return new BookModel(
            $books[0]['idBook'],
            $books[0]['name'],
            $books[0]['description'],
            $books[0]['address'],
            $books[0]['lat'],
            $books[0]['lng'],
            $books[0]['type'],
            $this->categoryRepository->find($books[0]['category_idcategory'])
        );
    }
}