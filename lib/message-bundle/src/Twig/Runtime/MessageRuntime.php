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

namespace Mazarini\MessageBundle\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class MessageRuntime implements RuntimeExtensionInterface
{
    private bool $closable;
    private string $default;
    /**
     * @var array<string,string>
     */
    private array $types;

    /**
     * __construct.
     *
     * @param array<string,string> $types
     *
     * @return void
     */
    public function __construct(bool $closable, array $types, string $default)
    {
        $this->closable = $closable;
        $this->types = $types;
        $this->default = $default;
    }

    /**
     * alertClass.
     */
    public function alertClass(string $type): string
    {
        return $this->types[$type] ?? $this->default;
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
     * setClosable.
     */
    public function setClosable(bool $closable): self
    {
        $this->closable = $closable;

        return $this;
    }

    public function isClosable(): bool
    {
        return $this->closable;
    }
}
