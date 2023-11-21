<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlTest extends WebTestCase
{
    /**
     *  @dataProvider urlProvider
     */
    public function testUrl(string $url, string $h1): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', $url);

        self::assertResponseIsSuccessful();
        self::assertSelectorTextContains('h1', $h1);
    }


    /**
     * urlProvider
     *
     * @return array<int,mixed>
     */
    public function urlProvider(): array
    {
        return [
            ['', 'HomepageController!'],
            ['/admin', 'AdminController!']
        ];
    }
}
