<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectMutationFieldConfigGenerator;

use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType\ElementDescriptorInputType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;

class ManyToManyRelation extends Base
{
    protected $elementInputType;

    public function __construct(Service $graphQlService, ElementDescriptorInputType $elementInputType)
    {
        $this->elementInputType = $elementInputType;
        parent::__construct($graphQlService);
    }

    /** {@inheritdoc } */
    public function getGraphQlMutationFieldConfig($nodeDef, $class, $container = null, $params = [])
    {
        $processor = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor\ManyToManyRelation($nodeDef);
        $processor->setGraphQLService($this->getGraphQlService());

        $inputType = $this->getGraphQlService()->getDataObjectTypeDefinition('elementdescriptor_input');

        return [
            'arg' => ['type' => Type::listOf($inputType)],
            'processor' => [$processor, 'process'],
        ];
    }
}
