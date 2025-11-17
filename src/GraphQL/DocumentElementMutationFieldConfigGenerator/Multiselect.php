<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementMutationFieldConfigGenerator;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;

class Multiselect extends Base
{
    /** @var \OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementInputProcessor\Multiselect */
    public $processor;

    public function __construct(Service $graphQlService, \OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementInputProcessor\Multiselect $processor)
    {
        parent::__construct($graphQlService);
        $this->processor = $processor;
    }

    /**
     * @return array
     */
    public function getDocumentElementMutationFieldConfig()
    {
        return [
            'arg' => new InputObjectType(
                [
                    'name' => 'document_element_input_multisleect',
                    'fields' => [
                        '_editableName' => Type::nonNull(Type::string()),
                        'selections' => Type::listOf(Type::string()),
                    ],
                ]
            ),
            'processor' => [$this->processor, 'process'],
        ];
    }
}
