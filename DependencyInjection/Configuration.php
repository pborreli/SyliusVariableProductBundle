<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sylius\Bundle\VariableProductBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This class contains the configuration information for the bundle.
 *
 * This information is solely responsible for how the different configuration
 * sections are normalized, and merged.
 *
 * @author Paweł Jędrzejewski <pjedrzejewski@diweb.pl>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sylius_variable_product');

        $this->addClassesSection($rootNode);

        return $treeBuilder;
    }

    /**
     * Adds `classes` section.
     *
     * @param ArrayNodeDefinition $node
     */
    private function addClassesSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('classes')
                    ->isRequired()
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('variant')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->isRequired()->end()
                                ->scalarNode('controller')->defaultValue('Sylius\\Bundle\\VariableProductBundle\\Controller\\VariantController')->end()
                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                ->scalarNode('form')->defaultValue('Sylius\\Bundle\\VariableProductBundle\\Form\\Type\\VariantType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('option')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Sylius\\Bundle\\VariableProductBundle\\Model\\Option')->end()
                                ->scalarNode('controller')->defaultValue('Sylius\\Bundle\\ResourceBundle\\Controller\\ResourceController')->end()
                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                ->scalarNode('form')->defaultValue('Sylius\\Bundle\\VariableProductBundle\\Form\\Type\\OptionType')->end()
                            ->end()
                        ->end()
                        ->arrayNode('option_value')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('model')->defaultValue('Sylius\\Bundle\\VariableProductBundle\\Model\\OptionValue')->end()
                                ->scalarNode('controller')->defaultValue('Sylius\\Bundle\\ResourceBundle\\Controller\\ResourceController')->end()
                                ->scalarNode('repository')->cannotBeEmpty()->end()
                                ->scalarNode('form')->defaultValue('Sylius\\Bundle\\VariableProductBundle\\Form\\Type\\OptionValueType')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
