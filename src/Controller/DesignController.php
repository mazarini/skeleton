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
    private $pageDefault = '';
    private $stepDefault = '';
    private $variantDefault = '';

    /**
     * @Route("/design", name="design")
     */
    public function index(Request $request)
    {
        $page = $request->get('page');
        $pages = $this->getPages();
        if (isset($pages[$page])) {
            $currentPage = $page;
        } else {
            $currentPage = $this->pageDefault;
        }

        $step = $request->get('step');
        $steps = $this->getSteps();
        if (isset($steps[$step])) {
            $currentStep = $step;
        } else {
            $currentStep = $this->stepDefault;
        }

        $variant = $request->get('variant');
        $variants = $this->getVariants($steps[$currentStep]);
        if (isset($variants[$variant])) {
            $currentVariant = $variant;
        } else {
            $currentVariant = $this->variantDefault;
        }

        $render = 'design/'.$steps[$currentStep].'/'.$variants[$currentVariant];
        if (!file_exists($this->getParameter('kernel.project_dir').'/templates/'.$render)) {
            $render = 'design/debug.html.twig';
        }

        return $this->render($render, [
            'base' => $pages[$currentPage],
            'render' => $render,
            'current' => ['page' => $currentPage, 'step' => $currentStep, 'variant' => $currentVariant],
            'pages' => $pages,
            'steps' => $steps,
            'variants' => $variants,
        ]);
    }

    private function getTemplate()
    {
        return $this->getParameter('kernel.project_dir').'/templates';
    }

    private function getDesign()
    {
        return $this->getTemplate('kernel.project_dir').'/design';
    }

    private function getLayout()
    {
        return $this->getTemplate('kernel.project_dir').'/layout';
    }

    private function getPages(): array
    {
        $ext = '.html.twig';
        $dirs = glob($this->getLayout().'/*.html.twig');
        $pages = [];
        foreach ($dirs as $dir) {
            $baseName = basename($dir);
            $pages[$baseName] = 'layout/'.$baseName;
            if ('' === $this->pageDefault) {
                $this->pageDefault = $baseName;
            }
        }

        return $pages;
    }

    private function getSteps(): array
    {
        $dirs = glob($this->getDesign().'/??-*');
        $steps = [];
        foreach ($dirs as $dir) {
            $baseName = basename($dir);
            $label = mb_substr($baseName, 3);
            $steps[$label] = $baseName;
            if ('' === $this->stepDefault) {
                $this->stepDefault = $label;
            }
        }

        return $steps;
    }

    private function getVariants($stepDir)
    {
        $ext = '.html.twig';
        $dirs = glob($this->getDesign().'/'.$stepDir.'/??-*'.$ext);
        $variants = [];
        foreach ($dirs as $dir) {
            $baseName = basename($dir, $ext);
            $label = mb_substr($baseName, 3);
            $variants[$label] = $baseName.$ext;
            if ('' === $this->variantDefault) {
                $this->variantDefault = $label;
            }
        }

        return $variants;
    }
}
