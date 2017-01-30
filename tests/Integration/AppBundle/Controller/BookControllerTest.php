<?php

namespace tests\Integration\AppBundle\Controller;

use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

class BookControllerTest extends WebTestCase
{
    /** @var Client */
    private $client;

    public function setUp()
    {
        $this->client = $this->makeClient();
      //  $this->loadFixtures([
       //     'src\AppBundle\DataFixtures\ORM\Book\BookData',
        //]);
    }

    public function testBooks()
    {
        $route =  $this->getUrl('api_1_get_books');
        $this->client->request('GET', $route, array('ACCEPT' => 'application/json'));
        $response = $this->client->getResponse();
        $this->assertEquals(200, $response->getStatusCode());

        $content = $response->getContent();
        $decoded = json_decode($content, true);
        $this->assertTrue(is_array($decoded));

    //    $this->assertTrue(sizeof($decoded['data']) > 0);
        foreach($decoded['data'] as $row) {
            $this->assertInternalType('string', $row['id']);
            $this->assertInternalType('string', $row['title']);
            $this->assertInternalType('string', $row['created_at']);
        }
    }
}
