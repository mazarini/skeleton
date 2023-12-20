<?php

/*
 * Copyright (C) 2023 Mazarini <mazarini@protonmail.com>.
 * This file is part of mazarini/user-bundle.
 *
 * mazarini/user-bundle is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.
 *
 * mazarini/user-bundle is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License
 */

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    public function testNew(): void
    {
        $entity = new User();
        $this->assertTrue($entity->isNew());
        $this->assertSame(0, $entity->getId());
    }

    public function testGetter(): void
    {
        $entity = new User();
        $this->assertSame(['ROLE_USER'], $entity->getRoles());
        $entity
            ->setEmail('admin@admin.com')
            ->setPassword('password')
            ->setPublicName('publicName')
            ->setRoles(['ROLE_ADMIN']);
        $this->assertSame('admin@admin.com', $entity->getEmail());
        $this->assertSame('password', $entity->getPassword());
        $this->assertSame('publicName', $entity->getPublicName());
        $this->assertTrue(\in_array('ROLE_ADMIN', $entity->getRoles()));
        $this->assertTrue(\in_array('ROLE_USER', $entity->getRoles()));
    }
}
