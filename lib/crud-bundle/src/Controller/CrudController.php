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

namespace Mazarini\CrudBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Mazarini\EntityBundle\Entity\EntityInterface;
use Mazarini\EntityBundle\Entity\Entity;
use Mazarini\EntityBundle\Page\Paginator;
use Mazarini\EntityBundle\Repository\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class CrudController extends AbstractController
{
    protected ?EntityInterface $parent = null;
    protected EntityInterface $entity;
    protected string $editTemplate;
    protected string $showTemplate;
    protected string $listTemplate;

    protected int $perPage;

    /**
     * pageAction
     *
     * @param  EntityRepository<Entity> $articleRepository
     * @param  int|null $page
     * @return Response
     */
    public function pageAction(EntityRepository $articleRepository, ?int $page): Response
    {
        $paginator = new Paginator($page);
        if (isset($this->perPage)) {
            $paginator->setPerPage($this->perPage);
        }
        $articleRepository->fillPage($paginator);
        if (!$paginator->existsCurrentPage()) {
            throw new NotFoundHttpException('Sorry page not existing!');
        }

        return $this->render($this->listTemplate, [
            'parent' => $this->parent,
            'paginator' => $paginator,
        ]);
    }

    public function showAction(EntityInterface $entity): Response
    {
        return $this->render($this->showTemplate, [
            'entity' => $entity,
        ]);
    }

    protected function editAction(Request $request, EntityInterface $entity, EntityManagerInterface $entityManager): Response
    {
        $this->entity = $entity;

        $form = $this->createForm($this->getFormType(), $entity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($entity->isNew()) {
                $entityManager->persist($entity);
            }
            $entityManager->flush();

            return $this->redirectToShow();
        }

        return $this->render($this->editTemplate, [
            'entity' => $entity,
            'form' => $form,
        ]);
    }

    abstract protected function getFormType(): string;

    /**
     * deleteAction.
     *
     * @param array<string,mixed> $redirectParameters
     */
    public function deleteAction(Request $request, EntityInterface $entity, EntityManagerInterface $entityManager, array $redirectParameters): Response
    {
        $token = $request->request->get('_token');
        switch (false) {
            case \is_string($token):
                $this->addFlash('error', 'Erreur technique');
                break;
            case $this->isCsrfTokenValid('delete' . $entity->getId(), $token):
                $this->addFlash('error', 'Erreur technique');
                break;
            case $this->isDeletable($entity):
                break;
            default:
                $this->addFlash('info', 'Fiche supprimer');
                $entityManager->remove($entity);
                $entityManager->flush();
        }

        return $this->redirectToIndex($redirectParameters);
    }

    protected function isDeletable(EntityInterface $entity): bool
    {
        return true;
    }

    /**
     * redirectToIndex.
     *
     * @param array<string,mixed> $redirectParameters
     */
    abstract protected function redirectToIndex(array $redirectParameters): Response;

    abstract protected function redirectToShow(): Response;
}
