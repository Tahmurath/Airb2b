<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReserveTest extends WebTestCase
{
    public static int $reserve_id;

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
            content: json_encode(['reserve_title'=>'TheTestTitle'])
        );
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();
        $this->assertSame(201, $response->getStatusCode());
        $this->assertJson($response->getContent());


        $json = $response->getContent();
        $reserve = json_decode($json);

        static::$reserve_id = $reserve->id;

//        dd($this->reserve_id);
        $this->assertStringContainsString('createdAt',$json);

        $this->assertEquals('TheTestTitle',$reserve?->reserveTitle);

    }

    /**
     * @depends testCreate
     */
    public function testIndex(): void
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

        $this->assertStringContainsString('createdAt',$json);

        //$this->assertObjectHasProperty('createdAt',$array[0]);
        //$this->assertEquals('TheTestTitle',$array[0]?->reserveTitle);


//        $this->assertSelectorTextContains('h1', 'Hello World');
    }

    /**
     * @depends testCreate
     */
    public function testDelete(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'DELETE',
            uri: '/reserve/'.static::$reserve_id,
            server: [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
            ],
            content: json_encode([])
        );
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();
        $this->assertSame(204, $response->getStatusCode());
        //$this->assertJson($response->getContent());


//        $json = $response->getContent();
//        $array = json_decode($json);

        //dd($array);

        //$this->assertEquals('1_hamid',$array[0]?->id);

        //$this->assertStringContainsString('createdAt',$json);

    }

}
