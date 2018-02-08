<?php

namespace Test\AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TestCategoryController extends WebTestCase
{
    public function testGetAllCategories()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/post/hello-world');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Hello World")')->count()
        );
    }
}
