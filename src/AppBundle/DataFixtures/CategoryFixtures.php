<?php

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const BOOK_CATEGORY_REFERENCE = 'book-category';

    public function load(ObjectManager $manager)
    {
        $category = new Category(
            'test Kategoria',
            'test opis',
            '2b8c4a81-d21c-4b0b-865d-568ea86819cd'
        );

        $manager->persist($category);
        $manager->flush();

        $this->addReference(self::BOOK_CATEGORY_REFERENCE, $category);
    }
}