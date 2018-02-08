<?php


namespace AppBundle\Category\CommandHandler;


use AppBundle\Category\Command\DeleteCategoryCommand;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Entity\Category;

final class DeleteCategoryHandler
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * AddCategoryHandler constructor.
     *
     * @param CategoryRepository $categoryRepository c
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Command handle method
     *
     * @param DeleteCategoryCommand $command
     *
     * @return void
     */
    public function handle(DeleteCategoryCommand $command): void
    {
        $this->categoryRepository->removeElement($command->getIdCategory());
    }
}