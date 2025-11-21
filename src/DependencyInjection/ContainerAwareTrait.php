<?php
declare(strict_types=1);

namespace OpenDxp\Bundle\DataHubBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerInterface;

trait ContainerAwareTrait
{
    protected ?ContainerInterface $container;

    public function setContainer(?ContainerInterface $container): void
    {
        $this->container = $container;
    }
}
