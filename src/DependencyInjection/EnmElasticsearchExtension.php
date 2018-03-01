<?php
declare(strict_types=1);

namespace Enm\Bundle\Elasticsearch\DependencyInjection;

use Enm\Elasticsearch\DocumentManager;
use Enm\Elasticsearch\DocumentManagerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * @author Philipp Marien <marien@eosnewmedia.de>
 */
class EnmElasticsearchExtension extends ConfigurableExtension
{
    /**
     * @param array $mergedConfig
     * @param ContainerBuilder $container
     * @throws \Exception
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $container->autowire(DocumentManager::class)
            ->setArgument('index', $mergedConfig['index'])
            ->setArgument('host', $mergedConfig['host']);

        foreach ((array)$mergedConfig['mappings'] as $className => $mapping) {
            $container->getDefinition(DocumentManager::class)->addMethodCall(
                'registerMapping',
                [
                    $className,
                    (array)$mapping
                ]
            );
        }

        foreach ((array)$mergedConfig['settings'] as $className => $settings) {
            $container->getDefinition(DocumentManager::class)->addMethodCall(
                'registerSettings',
                [
                    $className,
                    (array)$settings
                ]
            );
        }

        $container->setAlias(DocumentManagerInterface::class, DocumentManager::class);
    }
}
