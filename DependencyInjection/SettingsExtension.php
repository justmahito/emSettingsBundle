<?php

namespace EM\SettingsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class SettingsExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('twig.xml');
        $loader->load(sprintf('%s.xml', $config['db_driver']));
        $container->setParameter('em.setting.model.class', $config['entity']);
        $container->setParameter('em.setting.list.delimiter', $config['array_delemiter']);
        $container->setParameter('em.model.manager.name', $config['model_manager']);
        $container->setAlias('em.settings', $config['setting_manager']);

    }
}
