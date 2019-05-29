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

namespace App\Utils\LoremIpsum;

trait MailTrait
{
    private $tld = ['com', 'org', 'net', 'ovh', 'fr'];

    abstract public function word();

    abstract public function uniqWord();

    public function domain()
    {
        return $this->word().'.'.$this->tld();
    }

    public function mail()
    {
        return $this->word().'@'.$this->domain();
    }

    private function tld()
    {
        return $this->tld[rand(0, \count($this->tld) - 1)];
    }
}
