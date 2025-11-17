<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentType;

use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\General\FolderType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;

class DocumentFolderType extends FolderType
{
    /**
     * @param array $config
     * @param array $context
     */
    public function __construct(Service $graphQlService, $config = [], $context = [])
    {
        parent::__construct($graphQlService, ['name' => 'document_folder'], $context);
    }

    /**
     * @param array $config
     */
    public function build(&$config)
    {
        $resolver = new \OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver\Element('document', $this->getGraphQLService());
        $documentResolver = new \OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver\Document(new \OpenDxp\Model\Document\Service(), $this->getGraphQlService());
        $documentTree = $this->getGraphQlService()->buildGeneralType('document_tree');
        $documentTranslation = $this->getGraphQlService()->buildGeneralType('document_translation');

        {
            $config['fields'] = [
                'id' => [
                    'name' => 'id',
                    'type' => Type::id(),
                ],
                'filename' => Type::string(),
                'fullpath' => [
                    'type' => Type::string(),
                ],
                'creationDate' => Type::int(),
                'modificationDate' => Type::int(),
                'parent' => [
                    'type' => $documentTree,
                    'resolve' => [$resolver, 'resolveParent'],
                ],
                'children' => [
                    'type' => Type::listOf($documentTree),
                    'resolve' => [$resolver, 'resolveChildren'],
                ],
                '_siblings' => [
                    'type' => Type::listOf($documentTree),
                    'resolve' => [$resolver, 'resolveSiblings'],
                ],
                'translations' => [
                    'args' => ['defaultLanguage' => ['type' => Type::string()]],
                    'type' => Type::listOf($documentTranslation),
                    'resolve' => [$documentResolver, 'resolveTranslations'],
                ],
            ];
        }
    }
}
