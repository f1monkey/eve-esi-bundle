<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class UserAgentHeaderInjector
 *
 * @package F1monkey\EveEsiBundle\DependencyInjection\CompilerPass
 */
class UserAgentHeaderInjectorPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container): void
    {
        $userAgent = $container->getParameter('f1monkey.eve_esi.user_agent');
        if ($userAgent !== null) {
            $oauthRequestPrototype = $container->getDefinition('f1monkey.eve_esi.oauth.request_prototype');
            $oauthRequestPrototype->setArgument('$userAgent', $userAgent);

            $esiRequestPrototype = $container->getDefinition('f1monkey.eve_esi.esi.request_prototype');
            $esiRequestPrototype->setArgument('$userAgent', $userAgent);
        }
    }
}