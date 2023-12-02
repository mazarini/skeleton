<?php

/*
 * Copyright (C) 2023 Mazarini <mazarini@protonmail.com>.
 * This file is part of mazarini/message-bundle.
 *
 * mazarini/message-bundle is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.
 *
 * mazarini/message-bundle is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License
 */

namespace App\Tests\Twig;

use Mazarini\MessageBundle\Twig\Runtime\MessageRuntime;
use PHPUnit\Framework\TestCase;

class RuntimeTest extends TestCase
{
    public function testMessageRuntime(): void
    {
        $message = new MessageRuntime([], '');
        $message->setDefault('default-class');
        $message->setTypes(['type' => 'class-type']);
        $this->assertSame($message->alertClass('type'), 'class-type');
        $this->assertSame($message->alertClass('x'), 'default-class');
    }
}
