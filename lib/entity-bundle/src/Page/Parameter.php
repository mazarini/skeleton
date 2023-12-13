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

class Parameter
{
    /**
     * @var array<string,mixed>
     */
    private array $criterias = [];
    /**
     * @var array<string,string>
     */
    private ?array $orderBy = null;
    private int $perPage = 10;
    protected ?int $currentPage;

    public function __construct(int $currentPage = null)
    {
        $this->currentPage = $currentPage;
    }

    /**
     * setCriterias.
     *
     * @param array<string,mixed> $criterias
     */
    public function setCriterias(array $criterias): static
    {
        $this->criterias = $criterias;

        return $this;
    }

    /**
     * getCriterias.
     *
     * @return array<string,mixed>
     */
    public function getCriterias(): array
    {
        return $this->criterias;
    }

    /**
     * setOrderBy.
     *
     * @param array<string,string> $orderBy
     */
    public function setOrderBy(array $orderBy): static
    {
        $this->orderBy = $orderBy;

        return $this;
    }

    /**
     * getOrderBy.
     *
     * @return array<string,string>
     */
    public function getOrderBy(): ?array
    {
        return $this->orderBy;
    }

    public function setPerPage(int $perPage): static
    {
        $this->perPage = $perPage;

        return $this;
    }

    protected function getPerPage(): int
    {
        return $this->perPage;
    }
}
