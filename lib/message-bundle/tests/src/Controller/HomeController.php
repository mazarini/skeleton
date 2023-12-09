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

namespace App\Controller;

use Mazarini\MessageBundle\Controller\MessageControllerTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    use MessageControllerTrait;

    #[Route('/{type0}/{type1}/{type2}', name: 'app_home')]
    public function index(string $type0 = '', string $type1 = '', string $type2 = ''): Response
    {
        if ('' !== $type0) {
            $this->addFlash($type0, 'Message');
        }
        if ('' !== $type1) {
            $this->addFlash($type1, 'Message 1');
        }
        if ('' !== $type2) {
            parent::addFlash($type2, 'Message 2');
        }

        return $this->render('base.html.twig');
    }
}
