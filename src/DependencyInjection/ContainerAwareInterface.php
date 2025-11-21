<?php
declare(strict_types=1);

namespace OpenDxp\Bundle\DataHubBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @internal
 */
interface ContainerAwareInterface
{
    public function setContainer(?ContainerInterface $container): void;
}
