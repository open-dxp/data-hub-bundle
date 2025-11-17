<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectMutationFieldConfigGenerator;

use GraphQL\Type\Definition\Type;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

class Numeric extends Base
{
    /** {@inheritdoc } */
    public function getGraphQlMutationFieldConfig($nodeDef, $class, $container = null, $params = [])
    {
        $processor = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor\Base($nodeDef);
        $processor->setGraphQLService($this->getGraphQlService());

        $type = Type::float();
        $nodeAttributes = $nodeDef['attributes'];
        $key = $nodeAttributes['attribute'];
        $fieldDefinition = $this->getGraphQlService()->getObjectFieldHelper()->getFieldDefinitionFromKey($class, $key);
        if ($fieldDefinition instanceof Data\Numeric) {
            if ($fieldDefinition->getInteger()) {
                $type = Type::int();
            }
        }

        return [
            'arg' => $type,
            'processor' => [$processor, 'process'],
        ];
    }
}
