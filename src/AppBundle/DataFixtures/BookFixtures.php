<?php

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BookFixtures extends Fixture implements DependentFixtureInterface
{
    public const OFFERED_BOOK__REFERENCE = 'book-offer';
    public const REQUIRED_BOOK__REFERENCE = 'book-required';

    public function load(ObjectManager $manager)
    {
        $book = new Book(
            'test ksiazka',
            'test opis',
            '12 nie wiem xDDD',
            '3.5',
            '4.5',
            'domek',
            $this->getReference(CategoryFixtures::BOOK_CATEGORY_REFERENCE),
            $this->getReference(UserFixtures::USER_OFFERED_REFERENCE),
            '2a8d16f1-1c5a-46ba-8f2b-a94339db1930'
        );

        $book2 = new Book(
            'test KSIAZKA DO OFERT',
            'test opis',
            '13 nie wiem xDDD',
            '3.5',
            '4.5',
            'domekKK',
            $this->getReference(CategoryFixtures::BOOK_CATEGORY_REFERENCE),
            $this->getReference(UserFixtures::USER_REQUIRED_REFERENCE),
            '377ebafc-2995-4448-9a19-617f7594c4a6'
        );

        $this->addReference(self::OFFERED_BOOK__REFERENCE, $book);
        $this->addReference(self::REQUIRED_BOOK__REFERENCE, $book2);

        $manager->persist($book);
        $manager->persist($book2);
        $manager->flush();


    }

    public function getDependencies()
    {
        return array(
            CategoryFixtures::class,
            UserFixtures::class,
        );
    }
}