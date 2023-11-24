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

namespace App\Twig\Extension;

use App\Twig\Runtime\AppMessageRuntime;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppMessageExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('alert_class', [AppMessageRuntime::class, 'alertClass']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('alert_class', [AppMessageRuntime::class, 'alertClass']),
        ];
    }
}
