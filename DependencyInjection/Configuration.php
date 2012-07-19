<?php

namespace EM\SettingsBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('em_settings');

        $rootNode
          ->children()
          ->scalarNode('model_manager')
            ->defaultNull()
          ->end()
          ->scalarNode('entity')
                ->defaultValue('Settings\\Bundle\\Entity\\Setting')
            ->end()
          ->scalarNode('array_delemiter')
            ->defaultValue(',')
          ->end()
          ->scalarNode('setting_manager')->defaultValue('em.settings.manager.default')->end()
          ->end();

        return $treeBuilder;
    }
}
