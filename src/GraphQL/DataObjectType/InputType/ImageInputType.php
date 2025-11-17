<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType\InputType;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;

class ImageInputType extends AbstractRelationInputType
{
    /**
     * @param array $config
     * @param array $context
     */
    public function __construct(Service $graphQlService, $config = ['name' => 'ImageInput'], $context = [])
    {
        parent::__construct($graphQlService, $config, $context);
    }
}
