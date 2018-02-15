<?php
/**
 * Created by PhpStorm.
 * User: zawisza
 * Date: 15.02.2018
 * Time: 15:16
 */

namespace AppBundle\Book\CommandHandler;


use AppBundle\Book\Command\EditBookCommand;
use AppBundle\Repository\BookRepository;
use AppBundle\Repository\CategoryRepository;

final class EditBookHandler
{
    private $bookRepository;

    private $categoryRepository;

    /**
     * AddCategoryHandler constructor.
     *
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository, CategoryRepository $categoryRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function handle(EditBookCommand $command): void
    {
        $category = $this->categoryRepository->find($command->getCategorycategory());

        $this->bookRepository->update(
            $command->getIdBook(),
            $command->getName(),
            $command->getDescription(),
            $command->getAddress(),
            $command->getLat(),
            $command->getLng(),
            $command->getType(),
            $category
        );
    }
}