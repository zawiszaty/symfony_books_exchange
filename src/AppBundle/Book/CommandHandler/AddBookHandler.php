<?php


namespace AppBundle\Book\CommandHandler;


use AppBundle\Entity\Book;
use AppBundle\Repository\BookRepository;
use AppBundle\Book\Command\AddBookCommand;
use AppBundle\Repository\CategoryRepository;

final class AddBookHandler
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    private $categoryRepository;

    /**
     * AddCategoryHandler constructor.
     *
     * @param BookRepository $bookRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(BookRepository $bookRepository, CategoryRepository $categoryRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Command handle method
     *
     * @return void
     */
    public function handle(AddBookCommand $command): void
    {
        $category = $this->categoryRepository->find($command->getCategorycategory());
        $book = new Book(
            $command->getName(),
            $command->getDescription(),
            $command->getAddress(),
            $command->getLat(),
            $command->getLng(),
            $command->getType(),
            $category
        );
        $this->bookRepository->save($book);
    }
}