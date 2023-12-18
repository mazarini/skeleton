<?php

/*
 * Copyright (C) 2023 Mazarini <mazarini@protonmail.com>.
 * This file is part of mazarini/crud-bundle.
 *
 * mazarini/crud-bundle is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.
 *
 * mazarini/crud-bundle is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License
 */

namespace App\Tests\Entity;

use App\Entity\Article;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    public function testNew(): void
    {
        $entity = new Article();
        $this->assertTrue($entity->isNew());
        $this->assertSame(0, $entity->getId());
    }

    public function testNotNew(): void
    {
        $entity = new Article();
        $reflectionClass = new \ReflectionClass(Article::class);
        $reflectionProperty = $reflectionClass->getProperty('id');
        $reflectionProperty->setValue($entity, 1);
        $this->assertFalse($entity->isNew());
        $this->assertSame(1, $entity->getId());
    }
}
