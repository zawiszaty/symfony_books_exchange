<?php
/**
 * Created by PhpStorm.
 * User: zawisza
 * Date: 15.02.2018
 * Time: 15:02
 */

namespace AppBundle\Book\CommandHandler;


use AppBundle\Book\Command\DeleteBookCommand;
use AppBundle\Repository\BookRepository;

/**
 * Class DeleteBookHandler
 * @package AppBundle\Book\CommandHandler
 */
class DeleteBookHandler
{
    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * DeleteBookHandler constructor.
     * @param BookRepository $bookRepository
     */
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    /**
     * @param DeleteBookCommand $command
     */
    public function handle(DeleteBookCommand $command): void
    {
        $this->bookRepository->removeElement($command->getIdBook());
    }
}