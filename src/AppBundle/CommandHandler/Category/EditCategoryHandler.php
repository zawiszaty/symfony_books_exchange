<?php

namespace AppBundle\CommandHandler\Category;


use AppBundle\Command\Category\EditCategoryCommand;
use AppBundle\Repository\CategoryRepository;

final class EditCategoryHandler
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
     * @param EditCategoryCommand $command c
     * @param string $id
     *
     * @return void
     */
    public function handle(EditCategoryCommand $command): void
    {
        $this->categoryRepository->update(
            $command->getIdCategory(),
            $command->getName(),
            $command->getDescription()
        );
    }
}