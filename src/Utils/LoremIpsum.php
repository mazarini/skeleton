<?php

/*
 * Copyright (C) 2019 Mazarini <mazarini@protonmail.com>.
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

namespace App\Utils;

use joshtronic\LoremIpsum as base;

class LoremIpsum extends base
{
    use LoremIpsum\MailTrait;
    use LoremIpsum\NameTrait;

    private $uniq = null;

    public function uniqWord($size = 0)
    {
        if (null === $this->uniq) {
            $this->uniq = $this->words;
        }
        $last = \count($this->uniq) - 1;
        $key = rand(0, $last);
        $word = $this->uniq[$key];
        $this->uniq[$key] = $this->uniq[$last];
        unset($this->uniq[$last]);
        if (mb_strlen($word) < $size) {
            $word = $this->uniqWord($size);
        }

        return $word;
    }
}
