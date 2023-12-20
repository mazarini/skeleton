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

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Mazarini\CrudBundle\Controller\CrudController;
use Mazarini\EntityBundle\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profile')]
class ProfileController extends CrudController
{
    /**
     * @var User
     */
    protected EntityInterface $entity;

    protected string $editTemplate = 'profile/edit.html.twig';
    protected string $showTemplate = 'profile/show.html.twig';
    protected string $listTemplate = 'profile/index.html.twig';

    #[Route('')]
    public function default(UserRepository $userRepository): Response
    {
        return $this->redirectToRoute('app_user_page', ['page' => 1], Response::HTTP_SEE_OTHER);
    }

    #[Route('/index.html', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->pageAction($userRepository, null);
    }

    #[Route('/page-{page}.html', name: 'app_user_page', methods: ['GET'])]
    public function page(UserRepository $userRepository, ?int $page): Response
    {
        $this->perPage = 3;

        return $this->pageAction($userRepository, $page);
    }

    #[Route('/new.html', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        return $this->editAction($request, new User(), $entityManager);
    }

    #[Route('/{id}/show.html', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->showAction($user);
    }

    #[Route('/{id}/edit.html', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        return $this->editAction($request, $user, $entityManager);
    }

    protected function getFormType(): string
    {
        return UserType::class;
    }

    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        return parent::deleteAction($request, $user, $entityManager, []);
    }

    /**
     * isDeletable.
     *
     * @param User $user
     */
    protected function isDeletable(EntityInterface $user): bool
    {
        return true;
    }

    /**
     * redirectToIndex.
     *
     * @param array<string,mixed> $parameters
     */
    /**
     * redirectToIndex.
     *
     * @param array<string,mixed> $parameters
     */
    protected function redirectToIndex(array $parameters): Response
    {
        return $this->redirectToRoute('app_user_index', $parameters, Response::HTTP_SEE_OTHER);
    }

    protected function redirectToShow(): Response
    {
        $parameters = ['id' => $this->entity->getId()];

        return $this->redirectToRoute('app_user_show', $parameters, Response::HTTP_SEE_OTHER);
    }
}
