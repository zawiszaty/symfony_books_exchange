<?php


namespace AppBundle\Provider;

use AppBundle\Entity\Category;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CategoryProvider
 *
 * @package AppBundle\Provider
 */
class CategoryProvider extends Provider
{
    /**
     * This method return all categories
     *
     * @return array
     */
    public function getAll(): array
    {
        $categories = $this->doctrine->getRepository(Category::class)->findAll();

        return $categories;
    }

    /**
     * This method return single category object
     *
     * @param int $id category id
     *
     * @return Category|null|object
     */
    public function getSingle(string $id): object
    {
        $category = $this->doctrine->getRepository(Category::class)->find($id);

        if (!$category) {
            throw new NotFoundHttpException('Category not Found');
        }

        return $category;
    }
}