<?php


namespace AppBundle\Book\CommandHandler;


use AppBundle\Entity\Book;
use AppBundle\Repository\BookRepository;
use AppBundle\Book\Command\AddBookCommand;
use AppBundle\Repository\UserRepository;

/**
 * Class AddBookHandler
 * @package AppBundle\Book\CommandHandler
 */
final class AddBookHandler
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * AddBookHandler constructor.
     *
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository, UserRepository $userRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Command handle method
     *
     * @return void
     */
    public function handle(AddBookCommand $command): void
    {
        $user = $this->userRepository->find($command->getUser());
        $book = new Book(
            $command->getName(),
            $command->getDescription(),
            $command->getAddress(),
            $command->getLat(),
            $command->getLng(),
            $command->getType(),
            $user
        );
        $book->setCreated();
        $this->bookRepository->save($book);
    }
}