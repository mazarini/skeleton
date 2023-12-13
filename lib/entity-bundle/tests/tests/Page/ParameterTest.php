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

use Mazarini\EntityBundle\Page\Parameter;
use PHPUnit\Framework\TestCase;

class ParameterTest extends TestCase
{
    public function testDefault(): void
    {
        $page = new Parameter();
        $this->assertEquals([], $page->getCriterias());
        $this->assertNull($page->getOrderBy());
    }

    public function testSetterGetter(): void
    {
        $page = new Parameter();
        $page->setCriterias(['un' => 'criteria']);
        $this->assertCount(1, $page->getCriterias());
        $this->assertsame('criteria', $page->getCriterias()['un']);
        $page->setOrderBy(['orderby' => 'asc']);
        $this->assertNotNull($page->getOrderBy());
        $this->assertCount(1, $page->getOrderBy());
        $this->assertsame('asc', $page->getOrderBy()['orderby']);
    }
}
