<?php

namespace Evolution7\GruntUseminBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('evolution7_grunt_usemin');

        $rootNode
            ->children()
                ->scalarNode('dev_path')
                    ->defaultValue('web')
                ->end()
                ->scalarNode('prod_path')
                    ->defaultValue('web/dist')
                ->end()
                ->scalarNode('manifests_dir')
                    ->defaultValue('manifests')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}