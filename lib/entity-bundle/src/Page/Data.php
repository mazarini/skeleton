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

namespace Mazarini\EntityBundle\Page;

class Data extends Parameter
{
    private int $count;
    /**
     * @var array<int,mixed>
     */
    private array $entities = [];

    public function setCount(int $count): static
    {
        $this->count = $count;

        return $this;
    }

    protected function getCount(): int
    {
        return $this->count;
    }

    /**
     * setEntities.
     *
     * @param array<int,mixed> $entities
     */
    public function setEntities(array $entities): static
    {
        $this->entities = $entities;

        return $this;
    }

    /**
     * getEntities.
     *
     * @return array<int,mixed>
     */
    public function getEntities(): array
    {
        return $this->entities;
    }

    public function getLimit(): ?int
    {
        if (null === $this->currentPage) {
            return null;
        }

        return $this->getPerPage();
    }

    public function getOffset(): ?int
    {
        if (null === $this->currentPage) {
            return null;
        }

        return ($this->currentPage - 1) * $this->getPerPage();
    }
}
