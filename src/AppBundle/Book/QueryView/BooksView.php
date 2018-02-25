<?php


namespace AppBundle\Book\QueryView;


use AppBundle\Book\Model\BookModel;
use AppBundle\Book\Query\BookQuery;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\UserRepository;
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

    private $userRepository;

    /**
     * BooksView constructor.
     * @param Connection $connection
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(Connection $connection, CategoryRepository $categoryRepository, UserRepository $userRepository)
    {
        $this->connection = $connection;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
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
                'b.category_idcategory',
                'b.user_id'
            )
            ->from('book', 'b')
            ->andWhere('b.archived = 0');
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
                    $this->categoryRepository->find($books['category_idcategory']),
                    $this->userRepository->find($books['user_id'])
                );
            }, $books);
    }

    /**
     * @param string $id
     * @param string $userId
     *
     * @return BookModel
     */
    public function getSingle(string $id, string $userId)
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
                'b.category_idcategory',
                'b.user_id'
            )
            ->from('book', 'b')
            ->where('b.idbook = :id')
            ->andWhere('b.archived = 0')
            ->setParameter('id', $id);
        $books = $this->connection->fetchAll(
            $queryBuilder->getSQL(),
            $queryBuilder->getParameters()
        );

        if ($userId != $books[0]['user_id']) {
            throw new \Exception('error');
        }

        return new BookModel(
            $books[0]['idBook'],
            $books[0]['name'],
            $books[0]['description'],
            $books[0]['address'],
            $books[0]['lat'],
            $books[0]['lng'],
            $books[0]['type'],
            $this->categoryRepository->find($books[0]['category_idcategory']),
            $this->userRepository->find($books[0]['user_id'])
        );
    }

    public function getAllUserBooks(string $id): array
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
                'b.category_idcategory',
                'b.user_id'
            )
            ->from('book', 'b')
            ->where('b.user_id = :id')
            ->andWhere('b.archived = 0')
            ->setParameter('id', $id);
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
                    $this->categoryRepository->find($books['category_idcategory']),
                    $this->userRepository->find($books['user_id'])
                );
            }, $books);
    }


}