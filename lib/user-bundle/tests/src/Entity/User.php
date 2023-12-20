<?php

/*
 * Copyright (C) 2023 Mazarini <mazarini@protonmail.com>.
 * This file is part of mazarini/user-bundle.
 *
 * mazarini/user-bundle is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.
 *
 * mazarini/user-bundle is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License
 */

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Mazarini\UserBundle\Entity\UserAbstract;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User extends UserAbstract
{
    #[ORM\Column(length: 180, unique: true)]
    private string $email = '';

    #[ORM\Column(length: 180)]
    private string $publicName = '';

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPublicName(): string
    {
        return $this->publicName;
    }

    public function setPublicName(string $publicName): static
    {
        $this->publicName = $publicName;

        return $this;
    }
}
