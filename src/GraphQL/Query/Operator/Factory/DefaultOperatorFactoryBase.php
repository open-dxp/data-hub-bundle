<?php

declare(strict_types=1);


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Query\Operator\Factory;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Query\Operator\OperatorInterface;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

abstract class DefaultOperatorFactoryBase implements OperatorFactoryInterface
{
    use ServiceTrait;

    /**
     * @var string
     */
    protected $className;

    public function __construct(Service $graphQlService, string $className)
    {
        $this->className = $className;
        $this->setGraphQLService($graphQlService);
    }

    /**
     * @param array|null $context
     *
     */
    public function build(array $configElement = [], $context = null): OperatorInterface
    {
        $operatorImpl = new $this->className($configElement, $context);
        $operatorImpl->setGraphQlService($this->getGraphQlService());

        return $operatorImpl;
    }
}
