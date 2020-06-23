<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\DependencyInjection;

use Exception;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class EveEsiExtension
 *
 * @package F1Monkey\EveEsiBundle\DependencyInjection
 */
class EveEsiExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @param array<string, mixed> $configs
     * @param ContainerBuilder     $container
     *
     * @throws Exception
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $processor     = new Processor();
        $configuration = new Configuration();

        $config = $processor->processConfiguration($configuration, $configs);

        // @todo

        $loader = new YamlFileLoader(
            $container, new FileLocator(__DIR__ . '/../Resources/config')
        );
        $loader->load('services.yaml');
    }
}