<?php

declare(strict_types=1);


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Query\Operator\Factory;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Query\Operator\OperatorInterface;

interface OperatorFactoryInterface
{
    /**
     * @param array|null $context
     *
     */
    public function build(array $configElement, $context = null): OperatorInterface;
}
