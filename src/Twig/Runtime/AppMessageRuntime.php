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

namespace App\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class AppMessageRuntime implements RuntimeExtensionInterface
{
    private string $default = 'danger';
    /**
     * @var array<string,string>
     */
    private array $types;

    /**
     * __construct.
     *
     * @param array<string,string>|null $types
     *
     * @return void
     */
    public function __construct(array $types = null)
    {
        if (null === $types) {
            $this->types = [
                'primary' => 'primary',
                'secondary' => 'secondary',
                'success' => 'success',
                'danger' => 'danger',
                'error' => 'danger',
                'warning' => 'warning',
                'info' => 'info',
                'light' => 'light',
                'dark' => 'dark',
            ];
        } else {
            $this->types = $types;
        }
    }

    /**
     * setDefault.
     */
    public function setDefault(string $default): self
    {
        $this->default = $default;

        return $this;
    }

    /**
     * setTypes.
     *
     * @param array<string,string> $types
     */
    public function setTypes(array $types): self
    {
        $this->types = $types;

        return $this;
    }

    /**
     * alertClass.
     */
    public function alertClass(string $type): string
    {
        return $this->types[$type] ?? $this->default;
    }
}
