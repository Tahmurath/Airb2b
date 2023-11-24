<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReserveTest extends WebTestCase
{
    public function testCreate(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'POST',
            uri: '/reserve',
            server: [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
            ],
            content: json_encode([])
        );
        $this->assertSame(201, $client->getResponse()->getStatusCode());

    }
    public function testSomething(): void
    {
        $client = static::createClient();
        //$crawler = $client->request('GET', '/reserve');

        $client->request(
            method: 'GET',
            uri: '/reserve',
            server:  [
                'HTTP_ACCEPT' => 'application/json',
            ]
        );
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());

        $json = $response->getContent();
        $array = json_decode($json);
        //dd($array[0]);
        $this->assertJson($json);

        $this->assertResponseIsSuccessful();

        //$this->assertObjectHasProperty('createdAt',$array[0]);
        $this->assertEquals('1_hamid',$array[0]?->id);

        $this->assertStringContainsString('createdAt',$json);
//        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
