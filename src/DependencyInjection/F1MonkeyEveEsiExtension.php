<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\DependencyInjection;

use Exception;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Class F1MonkeyEveEsiExtension
 *
 * @package F1Monkey\EveEsiBundle\DependencyInjection
 */
class F1MonkeyEveEsiExtension extends Extension
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
        $loader        = new YamlFileLoader(
            $container, new FileLocator(__DIR__ . '/../Resources/config')
        );

        $config = $processor->processConfiguration($configuration, $configs);

        if (isset($config['oauth'])) {
            $this->injectOauthParameters($config['oauth'], $container);
            $loader->load('oauth.yaml');
        }

        $loader->load('services.yaml');
    }

    /**
     * @param array<string, mixed> $config
     * @param ContainerBuilder     $container
     * @param LoaderInterface      $loader
     *
     * @throws Exception
     */
    protected function injectOauthParameters(array $config, ContainerBuilder $container)
    {
        $container->setParameter('f1monkey.eve_esi.oauth.base_url', $config['base_url']);
        $container->setParameter('f1monkey.eve_esi.oauth.callback_url', $config['callback_url']);
        $container->setParameter('f1monkey.eve_esi.oauth.client_id', $config['client_id']);
        $container->setParameter('f1monkey.eve_esi.oauth.client_secret', $config['client_secret']);
    }
}