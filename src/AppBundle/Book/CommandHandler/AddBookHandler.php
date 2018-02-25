<?php


namespace AppBundle\Book\CommandHandler;


use AppBundle\Entity\Book;
use AppBundle\Repository\BookRepository;
use AppBundle\Book\Command\AddBookCommand;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\UserRepository;

final class AddBookHandler
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    private $categoryRepository;
    private $userRepository;

    /**
     * AddCategoryHandler constructor.
     *
     * @param BookRepository $bookRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(BookRepository $bookRepository, CategoryRepository $categoryRepository, UserRepository $userRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Command handle method
     *
     * @return void
     */
    public function handle(AddBookCommand $command): void
    {
        $category = $this->categoryRepository->find($command->getCategorycategory());
        $user = $this->userRepository->find($command->getUser());
        $book = new Book(
            $command->getName(),
            $command->getDescription(),
            $command->getAddress(),
            $command->getLat(),
            $command->getLng(),
            $command->getType(),
            $category,
            $user
        );
        $this->bookRepository->save($book);
    }
}