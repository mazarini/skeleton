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

namespace Mazarini\UserBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class MazariniUserBundle extends AbstractBundle
{
    /**
     * loadExtension.
     *
     * @param array<mixed> $config
     */
    public function loadExtension(array $config, ContainerConfigurator $containerConfigurator, ContainerBuilder $containerBuilder): void
    {
        $services = $containerConfigurator->services();
        //        $services->defaults()
        //            ->autowire()
        //            ->autoconfigure();
        $services->load('Mazarini\UserBundle\\', __DIR__.'')
            ->exclude([
                __DIR__.'/Controller/',
                __DIR__.'/DependencyInjection/',
                __DIR__.'/Entity/',
                __DIR__.'/Kernel.php',
            ]);
        $services->set(self::class)
            ->public();
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
