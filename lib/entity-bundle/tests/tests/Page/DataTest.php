<?php

/*
 * Copyright (C) 2023 Mazarini <mazarini@protonmail.com>.
 * This file is part of mazarini/entity-bundle.
 *
 * mazarini/entity-bundle is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.
 *
 * mazarini/entity-bundle is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License
 */

namespace App\Tests\Page;

use Mazarini\EntityBundle\Page\Data;
use PHPUnit\Framework\TestCase;

class DataTest extends TestCase
{
    public function testNoPage(): void
    {
        $page = new Data();
        $this->assertNull($page->getLimit());
        $this->assertNull($page->getOffset());
    }

    public function testLimit(): void
    {
        $page = new Data(1);
        $this->assertSame(10, $page->getLimit());
        $page->setPerPage(15);
        $this->assertSame(15, $page->getLimit());
    }

    public function testEntities(): void
    {
        $page = new Data();
        $this->assertSame([], $page->getEntities());
        $page->setEntities(['entity']);
        $this->assertSame(['entity'], $page->getEntities());
    }

    public function testOffset(): void
    {
        $page = new Data(1);
        $this->assertSame(0, $page->getOffset());
        $page = new Data(3);
        $this->assertSame(20, $page->getOffset());
    }
}
