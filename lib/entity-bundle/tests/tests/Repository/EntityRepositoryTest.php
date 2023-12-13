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

namespace App\Tests\Repository;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Mazarini\EntityBundle\Page\Paginator;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EntityRepositoryTest extends KernelTestCase
{
    private ArticleRepository $repository;

    protected function setup(): void
    {
        $repository = $this->getContainer()->get(ArticleRepository::class);
        if ($repository instanceof ArticleRepository) {
            $this->repository = $repository;
        }
        $articles = $this->repository->findAll();
        foreach ($articles as $article) {
            $this->repository->remove($article);
        }
    }

    public function testNew(): void
    {
        $count = $this->repository->count();
        $entity = new Article();
        $entity->setLabel('label new');
        $this->assertTrue($entity->isNew());
        $this->repository->save($entity);
        $this->assertFalse($entity->isNew());
        $this->assertSame($count + 1, $this->repository->count());
    }

    public function testEdit(): void
    {
        $entity = new Article();
        $entity->setLabel('label new');
        $this->repository->save($entity);
        unset($entity);
        $entities = $this->repository->findAll();
        $entities[0]->setLabel('label edit');
        $this->repository->save($entities[0]);
        $entity = $this->repository->find($entities[0]->getId());
        $this->assertNotNull($entity);
        $this->assertSame('label edit', $entity->getLabel());
    }

    public function testRemove(): void
    {
        $entity = new Article();
        $entity->setLabel('label remove');
        $this->repository->save($entity);
        $id = $entity->getId();
        unset($entity);
        $entity = $this->repository->find($id);
        $this->assertNotNull($entity);
        $this->repository->remove($entity);
        $entity = $this->repository->find($id);
        $this->assertNull($entity);
    }

    public function testPage(): void
    {
        for ($i = 1; $i <= 15; ++$i) {
            $entity = new Article();
            $entity->setLabel(sprintf('Article %d', $i));
            $this->repository->save($entity);
        }
        $page = new Paginator();
        $this->repository->fillPage($page);
        $this->assertCount(15, $page->getEntities());
        $page = new Paginator(1);
        $this->repository->fillPage($page);
        $this->assertCount(10, $page->getEntities());
        $page = new Paginator(2);
        $this->repository->fillPage($page);
        $this->assertCount(5, $page->getEntities());
        $page = new Paginator(3);
        $this->repository->fillPage($page);
        $this->assertFalse($page->existsCurrentPage());
        $this->assertCount(0, $page->getEntities());
    }
}
