<?php
/**
 * Created by PhpStorm.
 * User: zawisza
 * Date: 05.02.2018
 * Time: 19:22
 */

namespace AppBundle\CommandHandler;


use AppBundle\Command\AddCategoryCommand;
use AppBundle\Entity\Category;
use AppBundle\Repository\CategoryRepository;

/**
 * Class AddCategoryHandler
 *
 * @package AppBundle\CommandHandler
 */
final class AddCategoryHandler
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
     * @param AddCategoryCommand $command c
     *
     * @return void
     */
    public function handle(AddCategoryCommand $command): void
    {
        $category = new Category(
            $command->getName(),
            $command->getDescription()
        );
        $this->categoryRepository->save($category);
    }
}