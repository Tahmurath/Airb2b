<?php

namespace App\Tests;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReserveTest extends WebTestCase
{
    public static int $reserve_id;
    public static int $user_id;


    private function createUser(ObjectManager $manager): int
    {
        $user = new User();
        $user->setEmail('test@test.con');
        $user->setRoles([
            'ROLE_ROOT','ROLE_ADMIN', 'ROLE_MANAGE'
        ]);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            '123456'
        );
        $user->setPassword($hashedPassword);
        $manager->persist($user);

        $manager->flush();

        static::$user_id = $user->getId();
        return $user->getId();
    }

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
            content: json_encode([
                'reserveTitle'=>'TheTestTitle',
                'createdBy' => $this->createUser()
            ])
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
    public function testUpdate(): void
    {
        $client = static::createClient();
        $client->request(
            method: 'PUT',
            uri: '/reserve/'.static::$reserve_id,
            server: [
                'HTTP_ACCEPT' => 'application/json',
                'CONTENT_TYPE' => 'application/json',
            ],
            content: json_encode(['reserveTitle'=>'TheUpdatedTestTitle'])
        );
        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();
        $this->assertSame(200, $response->getStatusCode());
        $this->assertJson($response->getContent());


        $json = $response->getContent();
        $reserve = json_decode($json);

        static::$reserve_id = $reserve->id;

//        dd($this->reserve_id);
        $this->assertStringContainsString('createdAt',$json);

        $this->assertEquals('TheUpdatedTestTitle',$reserve?->reserveTitle);
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
        //dd($array[0]->reserveTitle);
        $this->assertEquals('TheUpdatedTestTitle',$array[0]->reserveTitle);

        //$this->assertObjectHasProperty('createdAt',$array[0]);
        //$this->assertEquals('TheTestTitle',$array[0]?->reserveTitle);


//        $this->assertSelectorTextContains('h1', 'Hello World');
    }

    /**
     * @depends testCreate
     */
    public function testView(): void
    {
        $client = static::createClient();
        //$crawler = $client->request('GET', '/reserve');

        $client->request(
            method: 'GET',
            uri: '/reserve/'.static::$reserve_id,
            server:  [
                'HTTP_ACCEPT' => 'application/json',
            ]
        );
        $response = $client->getResponse();
        $this->assertSame(200, $response->getStatusCode());

        $json = $response->getContent();
        $reserve = json_decode($json);
        //dd($array[0]);
        $this->assertJson($json);

        $this->assertResponseIsSuccessful();

        $this->assertStringContainsString('createdAt',$json);
        $this->assertEquals('TheUpdatedTestTitle',$reserve?->reserveTitle);

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
