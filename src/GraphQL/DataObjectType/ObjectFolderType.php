<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType;

use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\General\FolderType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;

class ObjectFolderType extends FolderType
{
    /**
     * @param array $config
     * @param array $context
     */
    public function __construct(Service $graphQlService, $config = [], $context = [])
    {
        parent::__construct($graphQlService, ['name' => 'object_folder'], $context);
    }

    /**
     * @param array $config
     */
    public function build(&$config)
    {
        $propertyType = $this->getGraphQlService()->buildGeneralType('element_property');
        $objectTreeType = $this->getGraphQlService()->buildGeneralType('object_tree');

        $resolver = new \OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver\DataObject($this->getGraphQLService());

        $config['fields'] = [
            'id' => [
                'name' => 'id',
                'type' => Type::id(),
            ],
            'key' => Type::string(),
            'fullpath' => [
                'type' => Type::string(),
            ],
            'creationDate' => Type::int(),
            'modificationDate' => Type::int(),
            'parent' => [
                'type' => $objectTreeType,
                'resolve' => [$resolver, 'resolveParent'],
            ],
            'index' => [
                'type' => Type::int(),
                'resolve' => [$resolver, 'resolveIndex'],
            ],
            'childrenSortBy' => [
                'type' => Type::string(),
                'resolve' => [$resolver, 'resolveChildrenSortBy'],
            ],
            'children' => [
                'type' => Type::listOf($objectTreeType),
                'args' => [
                    'objectTypes' => [
                        'type' => Type::listOf(Type::string()),
                        'description' => 'list of object types (object, variant, folder)',
                    ],
                ],
                'resolve' => [$resolver, 'resolveChildren'],
            ],
            'properties' => [
                'type' => Type::listOf($propertyType),
                'args' => [
                    'keys' => [
                        'type' => Type::listOf(Type::string()),
                        'description' => 'comma separated list of key names',
                    ],
                ],
                'resolve' => [$resolver, 'resolveProperties'],
            ],
            '_siblings' => [
                'type' => Type::listOf($objectTreeType),
                'args' => [
                    'objectTypes' => [
                        'type' => Type::listOf(Type::string()),
                        'description' => 'list of object types (object, variant, folder)',
                    ],
                ],
                'resolve' => [$resolver, 'resolveSiblings'],
            ],
        ];
    }
}
