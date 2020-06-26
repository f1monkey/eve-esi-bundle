<?php
declare(strict_types=1);

namespace F1Monkey\EveEsiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package F1Monkey\EveEsiBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('f1monkey_eve_esi');

        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();
        $root     = $rootNode->children();

        $this->addOAuthOptions($root);
        $this->addEsiOptions($root);

        $rootNode->end();

        return $treeBuilder;
    }

    /**
     * @param NodeBuilder $node
     */
    protected function addOAuthOptions(NodeBuilder $node): void
    {
        // @phpstan-ignore-next-line
        $node
            ->arrayNode('oauth')
            ->info('EVE SSO Settings (https://developers.eveonline.com/applications)')
            ->children()
                ->scalarNode('base_url')
                    ->info('URL for the SSO server')
                    ->defaultValue('https://login.eveonline.com')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('client_id')
                    ->info('Application client id')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('client_secret')
                    ->info('Application secret key')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('callback_url')
                    ->info('Application callback URL')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
            ->end();
    }

    /**
     * @param NodeBuilder $node
     */
    protected function addEsiOptions(NodeBuilder $node): void
    {
        // @phpstan-ignore-next-line
        $node
            ->arrayNode('esi')
            ->info('EVE ESI Settings')
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('base_url')
                    ->info('URL for the ESI server')
                    ->defaultValue('https://esi.evetech.net/latest')
                    ->cannotBeEmpty()
                ->end()
            ->end();
    }
}
