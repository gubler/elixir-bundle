<?php

namespace Gubler\ElixirBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('gubler_elixir');
        $rootNode->children()
            ->scalarNode('web_directory')->defaultValue('%kernel.root_dir%/../web')->end()
            ->scalarNode('build_directory')->defaultValue('build')->end()
            ->scalarNode('url_subdirectory')->defaultValue('')->end()
            ->end();
        return $treeBuilder;
    }
}
