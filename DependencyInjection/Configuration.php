<?php namespace Ewll\DBBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * {@inheritdoc}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ewll_db');

        $rootNode
            ->fixXmlConfig('shard')
            ->fixXmlConfig('connection')
            ->children()
                ->arrayNode('connections')
                    ->defaultValue([])
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('database')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('username')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('password')->isRequired()->cannotBeEmpty()->end()
                            ->scalarNode('host')->cannotBeEmpty()->defaultValue('127.0.0.1')->end()
                            ->scalarNode('port')->cannotBeEmpty()->defaultValue('3306')->end()
                            ->scalarNode('charset')->cannotBeEmpty()->defaultValue('utf8mb4')->end()
                            ->arrayNode('options')
                                ->prototype('integer')
                                    ->defaultValue([])
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('shards')
                    ->defaultValue([])
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->prototype('array')
                            ->children()
                                ->scalarNode('host')->isRequired()->cannotBeEmpty()->end()
                                ->scalarNode('port')->isRequired()->cannotBeEmpty()->end()
                                ->scalarNode('database')->isRequired()->cannotBeEmpty()->end()
                                ->scalarNode('username')->isRequired()->cannotBeEmpty()->end()
                                ->scalarNode('password')->isRequired()->cannotBeEmpty()->end()
                                ->scalarNode('charset')->cannotBeEmpty()->defaultValue('utf8mb4')->end()
                                ->arrayNode('options')
                                    ->prototype('integer')
                                        ->defaultValue([])
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('logger')
                    ->children()
                        ->scalarNode('id')->isRequired()->defaultNull()->end()
                        ->scalarNode('channel')->isRequired()->defaultNull()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
