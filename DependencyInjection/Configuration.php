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
        $supportedDrivers = array('orm', 'mongodb');

        $rootNode
          ->children()
          ->scalarNode('db_driver')
              ->validate()
                  ->ifNotInArray($supportedDrivers)
                  ->thenInvalid('The driver %s is not supported. Please choose one of '.json_encode($supportedDrivers))
              ->end()
          ->defaultValue('orm')
          ->end()
          ->scalarNode('model_manager')
            ->defaultNull()
          ->end()
          ->arrayNode('entity')
              ->addDefaultsIfNotSet()
                  ->children()
                  ->scalarNode('orm')->defaultValue('EM\\SettingsBundle\\Entity\\Setting')->cannotBeEmpty()->end()
                  ->scalarNode('mongodb')->defaultValue('EM\\SettingsBundle\\Document\\Setting')->cannotBeEmpty()->end()
              ->end()
          ->end()
          ->scalarNode('array_delemiter')
            ->defaultValue(',')
          ->end()
          ->scalarNode('setting_manager')->defaultValue('em.settings.manager.default')->end()
          ->end();

        return $treeBuilder;
    }
}
