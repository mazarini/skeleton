<?php

/*
 * Copyright (C) 2023 Mazarini <mazarini@protonmail.com>.
 * This file is part of mazarini/skeleton.
 *
 * mazarini/skeleton is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.
 *
 * mazarini/skeleton is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License
 */

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
     * urlProvider.
     *
     * @return array<int,mixed>
     */
    public function urlProvider(): array
    {
        return [
            ['', 'HomepageController!'],
            ['/admin', 'AdminController!'],
        ];
    }
}
