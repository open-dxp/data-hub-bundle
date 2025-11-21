<?php
declare(strict_types=1);

namespace OpenDxp\Bundle\DataHubBundle\DependencyInjection\Compiler;

use OpenDxp\Bundle\DataHubBundle\DependencyInjection\ContainerAwareInterface;
use ReflectionClass;
use ReflectionException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Throwable;

class ContainerAwarePass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has('service_container')) {
            return;
        }

        $containerRef = new Reference('service_container');
        $parameterBag = $container->getParameterBag();

        foreach ($container->getDefinitions() as $definition) {
            $class = $definition->getClass();

            if ($class === null) {
                continue;
            }

            $class = $parameterBag->resolveValue($class);
            try {
                $reflectionClass = new ReflectionClass($class);

                if (!$reflectionClass->implementsInterface(ContainerAwareInterface::class)) {
                    continue;
                }

                foreach ($definition->getMethodCalls() as [$method, $args]) {
                    if ($method === 'setContainer') {
                        continue 2;
                    }
                }

                $definition->addMethodCall('setContainer', [$containerRef]);
            } catch (Throwable) {
                // Ignoring reflection exceptions here.
            }
        }
    }
}
