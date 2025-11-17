<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectMutationFieldConfigGenerator;

use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType\ElementDescriptorInputType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;

class AdvancedManyToManyObjectRelation extends Base
{
    protected $elementInputType;

    protected $fieldDefinition;

    public function __construct(Service $graphQlService, ElementDescriptorInputType $elementInputType)
    {
        $this->elementInputType = $elementInputType;
        parent::__construct($graphQlService);
    }

    /** {@inheritdoc } */
    public function getGraphQlMutationFieldConfig($nodeDef, $class, $container = null, $params = [])
    {
        $processor = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor\AdvancedManyToManyObjectRelation($nodeDef);
        $processor->setGraphQLService($this->getGraphQlService());

        $inputType = $this->getGraphQlService()->getDataObjectTypeDefinition('elementdescriptor_input');

        return [
            'arg' => ['type' => Type::listOf($inputType)],
            'processor' => [$processor, 'process'],
        ];
    }
}
