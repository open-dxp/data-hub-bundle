<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType;

use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

class InputQuantityValueType extends QuantityValueType
{
    /**
     * @param array $config
     * @param array $context
     */
    public function __construct(Service $graphQlService, Data $fieldDefinition = null, $config = [], $context = [])
    {
        $config['fields'] = [
            'value' => [
                'type' => Type::string(),
            ],
        ];
        parent::__construct($graphQlService, $fieldDefinition, $config, $context);
    }
}
