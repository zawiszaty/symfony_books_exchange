<?php

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Book;
use AppBundle\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class UserFixtures extends Fixture implements ContainerAwareInterface
{
    public $container;
    public const USER_OFFERED_REFERENCE = 'user-id';
    public const USER_REQUIRED_REFERENCE = 'user-id2';

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $userManager = $this->container->get('fos_user.user_manager');
        // Create our user and set details
        $user = $userManager->createUser();
        $user->setUsername('test');
        $user->setEmail('test@wp.pl');
        $user->setPlainPassword('test');
        //$user->setPassword('3NCRYPT3D-V3R51ON');
        $user->setId(1);
        $user->setEnabled(true);

        $user2 = $userManager->createUser();
        $user2->setUsername('test2');
        $user2->setEmail('test2@wp.pl');
        $user2->setPlainPassword('test');
        $user2->setId(2);
        //$user->setPassword('3NCRYPT3D-V3R51ON');
        $user2->setEnabled(true);

        // Update the user
        $userManager->updateUser($user, true);
        $userManager->updateUser($user2, true);
        $this->addReference(self::USER_OFFERED_REFERENCE, $user);
        $this->addReference(self::USER_REQUIRED_REFERENCE, $user2);
    }
}