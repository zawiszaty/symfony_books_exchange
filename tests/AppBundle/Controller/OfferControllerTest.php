<?php

namespace Test\AppBundle\Controller;

use AppBundle\DataFixtures\BookFixtures;
use AppBundle\DataFixtures\CategoryFixtures;
use AppBundle\DataFixtures\OfferFixtures;
use AppBundle\DataFixtures\UserFixtures;
use AppBundle\Entity\Offer;
use AppBundle\Test\FixtureAwareTestCase;

class OfferControllerTest extends FixtureAwareTestCase
{
    public function testGetUserAcceptedOffer()
    {
        $token = $this->login()['token'];

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        $res = $this->client->request('GET', 'api/panel/get/accepted/offer', [
            'headers' => $headers
        ]);

        $data = json_decode($res->getBody(), true);
        $offer = $this->entityManager->getRepository(Offer::class)->findBy(['offeredUser' => 1]);
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals(count($data), count($offer));
    }

    public function testGetNewOffer()
    {
        $token = $this->login()['token'];

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        $res = $this->client->request('GET', 'api/panel/get/new/user/offer', [
            'headers' => $headers
        ]);

        $data = json_decode($res->getBody(), true);
        $offer = $this->entityManager->getRepository(Offer::class)->findBy(['requiredUser' => 1]);
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals(count($data), count($offer));
    }

    public function testNewOffer()
    {
        $token = $this->login()['token'];

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        $res = $this->client->request('PUT', 'api/panel/add/offer', [
            'headers' => $headers,
            'form_params' => [
                'description' => 'test',
                'offeredBook' => '2a8d16f1-1c5a-46ba-8f2b-a94339db1930',
                'requiredBook' => '377ebafc-2995-4448-9a19-617f7594c4a6',
                'requiredUser' => 2,
            ]
        ]);
        $offer = $this->entityManager->getRepository(Offer::class)->findAll();
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals(3, count($offer), 'nie działa bo'.count($offer));
    }

    public function testAcceptedOffer()
    {
        $token = $this->login()['token'];

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        $res = $this->client->request('POST', 'api/panel/accepted/offer', [
            'headers' => $headers,
            'form_params' => [
                'idoffer' => "2"
            ]
        ]);

        $offer = $this->entityManager->getRepository(Offer::class)->find('2');
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals(1, $offer->isAccepted(), 'nie działa bo '.$offer->isAccepted());

    }
    public function testRejectedOffer()
    {
        $token = $this->login()['token'];

        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json',
        ];

        $res = $this->client->request('POST', 'api/panel/rejected/offer', [
            'headers' => $headers,
            'form_params' => [
                'idoffer' => "2"
            ]
        ]);

        $offer = $this->entityManager->getRepository(Offer::class)->find('2');
        $this->assertEquals(200, $res->getStatusCode());
        $this->assertEquals(1, $offer->isRejected(), 'nie działa bo '.$offer->isRejected());

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

    }
}
