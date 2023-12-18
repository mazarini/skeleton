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

namespace Mazarini\EntityBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Mazarini\EntityBundle\Entity\EntityInterface;
use Mazarini\EntityBundle\Page\Paginator;

/**
 *
 * @extends ServiceEntityRepository<EntityInterface>
 *
 */
class EntityRepository extends ServiceEntityRepository
{
    protected ManagerRegistry $registry;

    /**
     * __construct.
     *
     * @param class-string<EntityInterface> $className
     *
     * @return void
     */
    public function __construct(ManagerRegistry $registry, string $className)
    {
        parent::__construct($registry, $className);
    }

    public function save(EntityInterface $entity): static
    {
        if ($entity->isNew()) {
            $this->getEntityManager()->persist($entity);
        }
        $this->getEntityManager()->flush();

        return $this;
    }

    public function remove(EntityInterface $entity): static
    {
        $this->getEntityManager()->remove($entity);
        $this->getEntityManager()->flush();

        return $this;
    }

    public function count(array $criteria = []): int
    {
        return parent::count($criteria);
    }

    public function fillPage(Paginator $paginator): Paginator
    {
        $count = $this->count($paginator->getCriterias());
        $paginator->setCount($count);
        if ($count > 0 && $paginator->getLastPage() >= $paginator->getCurrentPage()) {
            $paginator->setEntities($this->findBy($paginator->getCriterias(), $paginator->getOrderBy(), $paginator->getLimit(), $paginator->getOffset()));
        }

        return $paginator;
    }
}
