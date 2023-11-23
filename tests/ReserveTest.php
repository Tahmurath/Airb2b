<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReserveTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/reserve');

        $client->request('GET', '/reserve', [], [], [
            'HTTP_ACCEPT' => 'application/json',
        ]);
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertJson($response->getContent());

        $this->assertResponseIsSuccessful();
        $this->assertStringContainsString('createdAt',$response->getContent());
//        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
