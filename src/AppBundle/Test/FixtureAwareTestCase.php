<?php

namespace AppBundle\Test;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidFactory;
use Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class FixtureAwareTestCase extends KernelTestCase
{
    /**
     * @var
     */
    public $client;

    /**
     * @var
     */
    public $entityManager;
    /**
     * @var ORMExecutor
     */
    private $fixtureExecutor;
    /**
     * @var ContainerAwareLoader
     */
    private $fixtureLoader;

    /**
     *
     */
    public function setUp()
    {
        $kernel = self::bootKernel();
        Uuid::setFactory(new UuidFactory());
        $this->client = new \GuzzleHttp\Client(['base_uri' => 'http://localhost:8080/']);

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function login()
    {
        $res = $this->client->request('POST', 'api/login_check', ['form_params' => [
            "_username" => "test",
            "_password" => "test"
        ]]);

        return json_decode($res->getBody(), true);
    }

    /**
     * Adds a new fixture to be loaded.
     *
     * @param FixtureInterface $fixture
     */
    protected function addFixture(FixtureInterface $fixture)
    {
        $this->getFixtureLoader()->addFixture($fixture);
    }

    /**
     * @return ContainerAwareLoader
     */
    private function getFixtureLoader()
    {
        if (!$this->fixtureLoader) {
            $this->fixtureLoader = new ContainerAwareLoader(self::$kernel->getContainer());
        }
        return $this->fixtureLoader;
    }

    /**
     * Executes all the fixtures that have been loaded so far.
     */
    protected function executeFixtures()
    {
        $this->getFixtureExecutor()->execute($this->getFixtureLoader()->getFixtures());
    }

    /**
     * @return ORMExecutor
     */
    private function getFixtureExecutor()
    {
        if (!$this->fixtureExecutor) {
            /** @var \Doctrine\ORM\EntityManager $entityManager */
            $entityManager = self::$kernel->getContainer()->get('doctrine')->getManager();
            $this->fixtureExecutor = new ORMExecutor($entityManager, new ORMPurger($entityManager));
        }
        return $this->fixtureExecutor;
    }
}