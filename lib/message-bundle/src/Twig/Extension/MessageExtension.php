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

namespace Mazarini\MessageBundle\Twig\Extension;

use Mazarini\MessageBundle\Twig\Runtime\MessageRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class MessageExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('alert_class', [MessageRuntime::class, 'alertClass']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('alert_class', [MessageRuntime::class, 'alertClass']),
        ];
    }
}
