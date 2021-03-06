<?php
declare(strict_types=1);

namespace Enm\Bundle\Elasticsearch\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     * @throws \Exception
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();

        $root = $treeBuilder->root('enm_elasticsearch')->children();
        $root->scalarNode('index')->isRequired();
        $root->scalarNode('host')->isRequired();

        $root->arrayNode('mappings')
            ->requiresAtLeastOneElement()
            ->useAttributeAsKey('className')
            ->variablePrototype();

        $root->arrayNode('settings')
            ->useAttributeAsKey('className')
            ->variablePrototype();

        return $treeBuilder;
    }
}
