<?php

namespace App\DependencyInjection;


use App\Services\MenuService;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class MenuItemsCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(MenuService::class)) {
            return;
        }

        $definition = $container->findDefinition(MenuService::class);

        $taggedServices = $container->findTaggedServiceIds('menu.items');

        foreach ($taggedServices as $id => $taggedService) {
            $definition->addMethodCall('addMenuItemsContributor', [new Reference($id)]);
        }
    }

}