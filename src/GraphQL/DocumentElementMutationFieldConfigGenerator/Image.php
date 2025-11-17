<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementMutationFieldConfigGenerator;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;

class Image extends Base
{
    //TODO extend it with markers, hotspots etc.

    /** @var \OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementInputProcessor\Image */
    protected $processor;

    public function __construct(Service $graphQlService, \OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementInputProcessor\Image $processor)
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
                    'name' => 'document_element_input_image',
                    'fields' => [
                        '_editableName' => Type::nonNull(Type::string()),
                        'id' => Type::int(),               // the target asset
                        'alt' => Type::string(),
                    ],
                ]
            ),
            'processor' => [$this->processor, 'process'],
        ];
    }
}
