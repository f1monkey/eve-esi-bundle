<?php
declare(strict_types=1);

namespace F1monkey\EveEsiBundle;

use F1monkey\EveEsiBundle\DependencyInjection\CompilerPass\UserAgentHeaderInjectorPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class F1MonkeyEveEsiBundle
 *
 * @package F1monkey\EveEsiBundle
 */
class F1monkeyEveEsiBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
        $container->addCompilerPass(new UserAgentHeaderInjectorPass());
    }
}
