<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Category;
use Doctrine\ORM\EntityRepository;

/**
 * Class CategoryRepository
 *
 * @package AppBundle\Repository
 */
class CategoryRepository extends EntityRepository
{
    /**
     * This method saving category object
     *
     * @param Category $category
     *
     * @return void
     */
    public function save(Category $category): void
    {
        $this->getEntityManager()->persist($category);
        $this->getEntityManager()->flush();
    }

    /**
     * @param string $id
     * @param string $name
     * @param string $description
     */
    public function update(string $id, string $name, string $description): void
    {
        $category = $this->find($id);

        if ($category->getName() != $name) {
            $category->changeName($name);
        }

        if ($category->getDescription() != $description) {
            $category->changeDescription($description);
        }

        $this->getEntityManager()->flush();
    }

    /**
     * @param string $id
     */
    public function remove(string $id)
    {
        $category = $this->find($id);
        $this->getEntityManager()->remove($category);
        $this->getEntityManager()->flush();
    }
}