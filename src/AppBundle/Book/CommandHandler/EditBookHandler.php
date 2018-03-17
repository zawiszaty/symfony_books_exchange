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

/**
 * Class EditBookHandler
 * @package AppBundle\Book\CommandHandler
 */
final class EditBookHandler
{
    /**
     * @var BookRepository
     */
    private $bookRepository;


    /**
     * AddCategoryHandler constructor.
     *
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @param EditBookCommand $command
     */
    public function handle(EditBookCommand $command): void
    {
        $this->bookRepository->update(
            $command->getIdBook(),
            $command->getName(),
            $command->getDescription(),
            $command->getAddress(),
            $command->getLat(),
            $command->getLng(),
            $command->getType()
        );
    }
}