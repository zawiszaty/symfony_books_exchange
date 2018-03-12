<?php

namespace Test\AppBundle\Controller;


use AppBundle\DataFixtures\BookFixtures;
use AppBundle\DataFixtures\CategoryFixtures;
use AppBundle\DataFixtures\OfferFixtures;
use AppBundle\DataFixtures\UserFixtures;
use AppBundle\Entity\Book;
use AppBundle\Test\FixtureAwareTestCase;

class BookControllerTest extends FixtureAwareTestCase
{
    public function testGetAllBooks()
    {
        $res = $this->client->request('GET', 'api/get/all/books');

        $data = json_decode($res->getBody(), true);
        $books = $this->entityManager->getRepository(Book::class)->findAll();
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals(count($data), count($books));

    }

    public function testGetSingleBook()
    {
        $token = $this->login()['token'];

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        $res = $this->client->request('GET', 'api/panel/get/book/2a8d16f1-1c5a-46ba-8f2b-a94339db1930', [
            'headers' => $headers
        ]);
        $data = json_decode($res->getBody(), true);
        $book = $this->entityManager->getRepository(Book::class)->find('2a8d16f1-1c5a-46ba-8f2b-a94339db1930');


        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals($data['idbook'], $book->getIdbook());
        $this->assertEquals($data['name'], $book->getName());
        $this->assertEquals($data['description'], $book->getDescription());
        $this->assertEquals($data['address'], $book->getAddress());
        $this->assertEquals($data['lat'], $book->getLat());
        $this->assertEquals($data['lng'], $book->getLng());
        $this->assertEquals($data['type'], $book->getType());
        $this->assertEquals($data['categorycategory']['idcategory'], $book->getCategorycategory()->getIdcategory());
        $this->assertEquals($data['user']['id'], $book->getUser()->getId());
    }

    public function testGetAllUserBooks()
    {
        $token = $this->login()['token'];

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        $res = $this->client->request('GET', 'api/panel/get/user/book', [
            'headers' => $headers
        ]);
        $data = json_decode($res->getBody(), true);
        $books = $this->entityManager->getRepository(Book::class)->findBy(['user' => '1']);

        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals(count($data), count($books));
    }

    public function testAddBook()
    {
        $token = $this->login()['token'];

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];
        $booksOld = $this->entityManager->getRepository(Book::class)->findAll();
        $res = $this->client->request('PUT', 'api/panel/add/book', [
            'headers' => $headers,
            'form_params' => [
                "name" => "test22",
                "description" => "test2",
                "address" => "tes2t",
                "lat" => 2.3,
                "lng" => 2.5,
                "type" => "nie sfs dsdf sdf sdf sd fs",
                "categorycategory" => "2b8c4a81-d21c-4b0b-865d-568ea86819cd",
            ]
        ]);
        $booksNew = $this->entityManager->getRepository(Book::class)->findAll();
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals(count($booksOld) + 1, count($booksNew));
    }

    public function testDeleteBook()
    {
//        $token = $this->login()['token'];
//
//        $headers = [
//            'Authorization' => 'Bearer ' . $token,
//            'Accept' => 'application/json',
//        ];

        $res = $this->client->request('DELETE', 'api/delete/2a8d16f1-1c5a-46ba-8f2b-a94339db1930/book');
        $book = $this->entityManager->getRepository(Book::class)->find('2a8d16f1-1c5a-46ba-8f2b-a94339db1930');

        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals(1, $book->isArchived());
    }

    public function testEditBook()
    {
        $token = $this->login()['token'];

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        $res = $this->client->request('POST', 'api/panel/edit/book', [
            'headers' => $headers,
            'form_params' => [
                "idbook"=> "2a8d16f1-1c5a-46ba-8f2b-a94339db1930",
                "name" => "test33",
                "description" => "test3",
                "address" => "tes3",
                "lat" => 2.4,
                "lng" => 2.6,
                "type" => "123",
                "categorycategory" => "2b8c4a81-d21c-4b0b-865d-568ea86819cd",
            ]
        ]);
        $book = $this->entityManager->getRepository(Book::class)->find('2a8d16f1-1c5a-46ba-8f2b-a94339db1930');
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals($book->getName(), 'test33');
        $this->assertEquals($book->getDescription(), 'test3');
        $this->assertEquals($book->getAddress(), 'tes3');
        $this->assertEquals($book->getLat(), '2.4');
        $this->assertEquals($book->getLng(), '2.6');
        $this->assertEquals($book->getType(), '123');


    }


    public function setUp()
    {
        parent::setUp();

        // Base fixture for all tests
        $this->addFixture(new CategoryFixtures());
        $this->addFixture(new UserFixtures());
        $this->addFixture(new BookFixtures());
        $this->addFixture(new OfferFixtures());

        $this->executeFixtures();

        // Fixtures are now loaded in a clean DB. Yay!
    }
}
