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

use Mazarini\EntityBundle\Page\Paginator;
use PHPUnit\Framework\TestCase;

class ParinatorTest extends TestCase
{
    public function testNoPage(): void
    {
        $page = new Paginator();
        $this->assertSame(1, $page->getCurrentPage());
        $this->assertSame(1, $page->getLastPage());
        $this->assertTrue($page->existsCurrentPage());
        $this->assertFalse($page->hasPrevious());
        $this->assertFalse($page->hasNext());
    }

    /**
     * @dataProvider PaginatorProvider
     */
    public function testPaginator(int $currentPage, int $count, int $lastPage, bool $existsCurrentPage, bool $hasPrevious, bool $hasNext): void
    {
        $page = new Paginator($currentPage);
        $page->setCount($count);
        $this->assertSame($currentPage, $page->getCurrentPage());
        $this->assertSame($lastPage, $page->getLastPage());
        $this->assertSame($existsCurrentPage, $page->existsCurrentPage());
        if ($existsCurrentPage) {
            $this->assertSame($hasPrevious, $page->hasPrevious());
            $this->assertSame($currentPage - 1, $page->getPreviousPage());
            $this->assertSame($hasNext, $page->hasNext());
            $this->assertSame($currentPage + 1, $page->getNextPage());
        }
    }

    /**
     * PaginatorProvider.
     *
     * @return \Traversable<array<mixed>>
     */
    public function PaginatorProvider(): \Traversable
    {
        yield [1, 9, 1, true, false, false];
        yield [1, 25, 3, true, false, true];
        yield [2, 25, 3, true, true, true];
        yield [3, 25, 3, true, true, false];
        yield [4, 25, 3, false, true, true];
    }
}
