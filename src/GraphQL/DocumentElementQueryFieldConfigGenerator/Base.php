<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

abstract class Base
{
    use ServiceTrait;

    public function __construct(Service $graphQlService)
    {
        $this->setGraphQLService($graphQlService);
    }

    /**
     * @return Type
     */
    abstract public function getFieldType();
}
