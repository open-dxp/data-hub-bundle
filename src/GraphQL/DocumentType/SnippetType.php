<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentType;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;

class SnippetType extends PageSnippetType
{
    /**
     * @param array $config
     * @param array $context
     */
    public function __construct(Service $graphQlService, DocumentElementType $documentElementType, $config = ['name' => 'document_snippet'], $context = [])
    {
        parent::__construct($graphQlService, $documentElementType, $config, $context);
    }
}
