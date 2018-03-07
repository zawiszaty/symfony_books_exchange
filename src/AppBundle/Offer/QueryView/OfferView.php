<?php


namespace AppBundle\Offer\QueryView;


use AppBundle\Offer\Model\OfferModel;
use AppBundle\Offer\Query\OfferQuery;
use AppBundle\Repository\BookRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\UserRepository;
use Doctrine\DBAL\Connection;

final class OfferView implements OfferQuery
{
    /**
     * @var Connection
     */
    private $connection;

    private $userRepository;

    private $bookRepository;

    /**
     * BooksView constructor.
     * @param Connection $connection
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(Connection $connection, UserRepository $userRepository, BookRepository $bookRepository)
    {
        $this->connection = $connection;
        $this->userRepository = $userRepository;
        $this->bookRepository = $bookRepository;
    }

    public function getUserAcceptedOffer(string $userId): array
    {
        $queryBuilder = $this->connection->createQueryBuilder()
            ->select(
                'o.idoffer',
                'o.offered_book',
                'o.required_book',
                'description',
                'seen',
                'accepted',
                'rejected',
                'offered_user',
                'required_user'
            )
            ->from('offer', 'o')
            ->where('o.offered_user = :id')
            ->setParameter('id', $userId);


        $offer = $this->connection->fetchAll(
            $queryBuilder->getSQL(),
            $queryBuilder->getParameters()
        );

        return array_map(
            function (array $offer) {
                return new OfferModel(
                    $offer['idoffer'],
                    $offer['description'],
                    $offer['seen'],
                    $offer['accepted'],
                    $offer['rejected'],
                    $this->bookRepository->find($offer['offered_book']),
                    $this->bookRepository->find($offer['required_book']),
                    $this->userRepository->find($offer['offered_user']),
                    $this->userRepository->find($offer['required_user'])
                );
            }, $offer);

    }

    public function getNewOffer(string $userId): array
    {
        $queryBuilder = $this->connection->createQueryBuilder()
            ->select(
                'o.idoffer',
                'o.offered_book',
                'o.required_book',
                'description',
                'seen',
                'accepted',
                'rejected',
                'offered_user',
                'required_user'
            )
            ->from('offer', 'o')
            ->where('o.required_user = :id')
            ->setParameter('id', $userId);


        $offer = $this->connection->fetchAll(
            $queryBuilder->getSQL(),
            $queryBuilder->getParameters()
        );

        return array_map(
            function (array $offer) {
                return new OfferModel(
                    $offer['idoffer'],
                    $offer['description'],
                    $offer['seen'],
                    $offer['accepted'],
                    $offer['rejected'],
                    $this->bookRepository->find($offer['offered_book']),
                    $this->bookRepository->find($offer['required_book']),
                    $this->userRepository->find($offer['offered_user']),
                    $this->userRepository->find($offer['required_user'])
                );
            }, $offer);
    }

}