<?php

namespace AppBundle\DataFixtures;


use AppBundle\Entity\Offer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class OfferFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $offer = new Offer(
            'test unit',
            $this->getReference(BookFixtures::OFFERED_BOOK__REFERENCE),
            $this->getReference(BookFixtures::REQUIRED_BOOK__REFERENCE),
            $this->getReference(UserFixtures::USER_OFFERED_REFERENCE),
            $this->getReference(UserFixtures::USER_REQUIRED_REFERENCE),
            0,
            0,
            0,
            '1'
        );
        $offer2 = new Offer(
            'test unit2',
            $this->getReference(BookFixtures::REQUIRED_BOOK__REFERENCE),
            $this->getReference(BookFixtures::OFFERED_BOOK__REFERENCE),
            $this->getReference(UserFixtures::USER_REQUIRED_REFERENCE),
            $this->getReference(UserFixtures::USER_OFFERED_REFERENCE),
            0,
            0,
            0,
            '2'
        );
        $manager->persist($offer);
        $manager->persist($offer2);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            BookFixtures::class,
            UserFixtures::class,
        );
    }
}