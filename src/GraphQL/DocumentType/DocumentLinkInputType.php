<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentType;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\ElementTag;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

class DocumentLinkInputType extends InputObjectType
{
    use ServiceTrait;

    /**
     * @param array $config
     * @param array $context
     */
    public function __construct(Service $graphQlService, $config = ['name' => 'document_link_input'], $context = [])
    {
        $this->setGraphQLService($graphQlService);
        $this->build($config);
        parent::__construct($config);
    }

    /**
     * @param array $config
     */
    public function build(&$config)
    {
        $config['fields'] = [
            'internal' => Type::int(),
            'internalType' => Type::string(),
//            'object' => new InputObjectType([
//                "name" => "document_link_input_object",
//                "fields" =>
//                    [
//                        'type' => Type::string(),
//                        'id' => Type::int()
//                    ]]),
            'direct' => Type::string(),
            'linktype' => Type::string(),
            'href' => Type::string(),
            'tags' => ElementTag::getElementTagInputTypeDefinition(),
        ];
    }
}
