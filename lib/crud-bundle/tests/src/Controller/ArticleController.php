<?php

/*
 * Copyright (C) 2023 Mazarini <mazarini@protonmail.com>.
 * This file is part of mazarini/crud-bundle.
 *
 * mazarini/crud-bundle is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.
 *
 * mazarini/crud-bundle is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License
 */

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Mazarini\CrudBundle\Controller\CrudController;
use Mazarini\EntityBundle\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/article')]
class ArticleController extends CrudController
{
    /**
     * @var Article
     */
    protected EntityInterface $entity;

    protected string $editTemplate = 'article/edit.html.twig';
    protected string $showTemplate = 'article/show.html.twig';
    protected string $listTemplate = 'article/list.html.twig';

    #[Route('/index.html', name: 'app_article_index', methods: ['GET'])]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->pageAction($articleRepository, null);
    }

    #[Route('/page-{page}.html', name: 'app_article_page', methods: ['GET'])]
    public function page(ArticleRepository $articleRepository, ?int $page): Response
    {
        $this->perPage = 3;

        return $this->pageAction($articleRepository, $page);
    }

    #[Route('/new.html', name: 'app_article_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        return $this->editAction($request, new Article(), $entityManager);
    }

    #[Route('/{id}/show.html', name: 'app_article_show', methods: ['GET'])]
    public function show(Article $article): Response
    {
        return $this->showAction($article);
    }

    #[Route('/{id}/edit.html', name: 'app_article_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        return $this->editAction($request, $article, $entityManager);
    }

    protected function getFormType(): string
    {
        return ArticleType::class;
    }

    #[Route('/{id}', name: 'app_article_delete', methods: ['POST'])]
    public function delete(Request $request, Article $article, EntityManagerInterface $entityManager): Response
    {
        return parent::deleteAction($request, $article, $entityManager, []);
    }

    /**
     * isDeletable.
     *
     * @param Article $article
     */
    protected function isDeletable(EntityInterface $article): bool
    {
        return true;
    }

    /**
     * redirectToIndex.
     *
     * @param array<string,mixed> $parameters
     */
    /**
     * redirectToIndex
     *
     * @param  array<string,mixed> $parameters
     * @return Response
     */
    protected function redirectToIndex(array $parameters): Response
    {
        return $this->redirectToRoute('app_article_index', $parameters, Response::HTTP_SEE_OTHER);
    }

    protected function redirectToShow(): Response
    {
        $parameters = ['id' => $this->entity->getId()];

        return $this->redirectToRoute('app_article_show', $parameters, Response::HTTP_SEE_OTHER);
    }
}
