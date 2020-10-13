<?php


namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CompareControllerTest extends WebTestCase
{

    public function testRequestHasJsonResponse(): void
    {
        $client = $this->createClient();

        $query = http_build_query([
            'first' => 'pestphp/pest',
            'second' => 'drupal/core',
        ]);

        $client->request(Request::METHOD_GET, '/compare?' . $query);

        $response = $client->getResponse()->getContent();

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $this->assertNotEmpty($response);
        $this->assertJson($response);
    }

    public function testRequestMustHaveTwoGivenRepositories(): void
    {
        $client = $this->createClient();

        $query = http_build_query([
            'first' => 'pestphp/pest',
        ]);

        $client->request(Request::METHOD_GET, '/compare?' . $query);

        $response = $client->getResponse()->getContent();

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());
        $this->assertNotEmpty($response);
        $this->assertJson($response);
        $this->assertEquals('{"error_message":"Given value is not a string type"}', $response);
    }

}