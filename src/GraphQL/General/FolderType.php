<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\General;

use GraphQL\Type\Definition\ObjectType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

abstract class FolderType extends ObjectType
{
    use ServiceTrait;

    /**
     * @param array $config
     * @param array $context
     */
    public function __construct(Service $graphQlService, $config = [], $context = [])
    {
        $this->setGraphQLService($graphQlService);
        $this->build($config);
        parent::__construct($config);
    }

    /**
     * @param array $config
     */
    abstract public function build(&$config);
}
