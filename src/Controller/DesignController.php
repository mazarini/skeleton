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

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DesignController extends AbstractController
{
    /**
     * @Route("/design/{debug}", name="design")
     */
    public function index(Request $request, string $debug = '')
    {
        $pages = $this->getDirContent('layout', '*');
        $currentPage = $this->getCurrent($request, 'page', $pages);

        $steps = $this->getDirContent('design', '??-*', '');
        $currentStep = $this->getCurrent($request, 'step', $steps);

        $variants = $this->getDirContent('design/'.$steps[$currentStep], '??-*');
        $currentVariant = $this->getCurrent($request, 'variant', $variants);

        $render = 'design/'.$steps[$currentStep].'/'.$variants[$currentVariant];
        if (file_exists($this->getDir().$render) && '' === $debug) {
            $template = $render;
        } else {
            $template = 'design/debug.html.twig';
        }

        return $this->render($template, [
            'base' => 'layout/'.$pages[$currentPage],
            'render' => $render,
            'current' => ['page' => $currentPage, 'step' => $currentStep, 'variant' => $currentVariant],
            'pages' => $pages,
            'steps' => $steps,
            'variants' => $variants,
        ]);
    }

    private function getDir(string $subDir = ''): string
    {
        $dir = $this->getParameter('kernel.project_dir').'/templates/';
        $subDir = trim($subDir, '/\\');
        if ('' !== $subDir) {
            $dir .= $subDir.'/';
        }
        if (!file_exists($dir)) {
            throw new \RuntimeException(sprintf('The file "%s" does not exist', $dir));
        }

        return $dir;
    }

    private function getDirContent(string $subDir, string $basename, string $ext = '.html.twig'): array
    {
        $start = mb_strlen($basename) - 1;
        $root = $this->getDir($subDir).$basename.$ext;
        $dirs = glob($root);
        $content = [];
        foreach ($dirs as $dir) {
            $value = basename($dir, $ext);
            $key = mb_substr($value, $start);
            $content[$key] = $value.$ext;
        }
        if (0 === \count($content)) {
            throw new \RuntimeException(sprintf('Nothing match with "%s"', $root));
        }

        return $content;
    }

    private function getCurrent(Request $request, string $name, array $array): string
    {
        $key = $request->get($name);

        return isset($array[$key]) ? $key : key($array);
    }
}
