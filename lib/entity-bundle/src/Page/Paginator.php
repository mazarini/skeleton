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

class Paginator extends Data
{
    public function getCurrentPage(): int
    {
        if (null === $this->currentPage) {
            return 1;
        }

        return $this->currentPage;
    }

    public function getLastPage(): int
    {
        if (null === $this->currentPage) {
            return 1;
        }

        return max(1, (int) (($this->getCount() + $this->getPerPage() - 1) / $this->getPerPage()));
    }

    public function hasPrevious(): bool
    {
        return $this->getCurrentPage() > 1;
    }

    public function hasNext(): bool
    {
        return $this->getLastPage() > $this->getCurrentPage();
    }

    public function getPreviousPage(): int
    {
        return $this->getCurrentPage() - 1;
    }

    public function getNextPage(): int
    {
        return $this->getCurrentPage() + 1;
    }

    public function existsCurrentPage(): bool
    {
        return $this->getLastPage() >= $this->getCurrentPage() && $this->getCurrentPage() >= 1;
    }
}
