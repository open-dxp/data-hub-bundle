<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentType;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;

class PageType extends PageSnippetType
{
    /**
     * @param array $config
     * @param array $context
     */
    public function __construct(Service $graphQlService, DocumentElementType $documentElementType, $config = ['name' => 'document_page'], $context = [])
    {
        parent::__construct($graphQlService, $documentElementType, $config, $context);
    }
}
