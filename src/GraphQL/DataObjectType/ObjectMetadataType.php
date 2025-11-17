<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\ClassTypeDefinitions;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver\ObjectMetadata;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;
use OpenDxp\Model\DataObject\Fieldcollection\Definition as FieldcollectionDefinition;
use OpenDxp\Model\DataObject\Objectbrick\Definition as ObjectbrickDefinition;

class ObjectMetadataType extends ObjectType
{
    use ServiceTrait;

    protected $class;

    /** @var Data */
    protected $fieldDefinition;

    /**
     * @param ClassDefinition|null $class
     * @param array $config
     */
    public function __construct(Service $graphQlService, Data $fieldDefinition = null, $class = null, $config = [])
    {
        $this->setGraphQLService($graphQlService);
        $this->class = $class;
        $this->fieldDefinition = $fieldDefinition;
        if ($class instanceof ObjectbrickDefinition) {
            $config['name'] = 'objectbrick_' . $class->getKey() . '_' . $fieldDefinition->getName();
        } elseif ($class instanceof FieldcollectionDefinition) {
            $config['name'] = 'fieldcollection_' . $class->getKey() . '_' . $fieldDefinition->getName();
        } else {
            $config['name'] = 'object_' . $class->getName() . '_' . $fieldDefinition->getName();
        }
        $this->build($config);
        parent::__construct($config);
    }

    /**
     * @param array $config
     */
    public function build(&$config)
    {
        $fieldHelper = $this->getGraphQlService()->getObjectFieldHelper();
        /** @var Data\AdvancedManyToManyObjectRelation $fieldDefinition */
        $fieldDefinition = $this->fieldDefinition;
        $class = $this->class;

        $className = $fieldDefinition->getAllowedClassId();
        $elementTypeDefinition = ClassTypeDefinitions::get($className);
        $metadataKeyValuePairType = ElementMetadataKeyValuePairType::getInstance();
        $resolver = new ObjectMetadata($fieldDefinition, $class, $fieldHelper);

        $fields = ['element' =>
            [
                'type' => $elementTypeDefinition,
                'resolve' => [$resolver, 'resolveElement'],
            ],
            'metadata' => [
                'type' => Type::listOf($metadataKeyValuePairType),
                'resolve' => [$resolver, 'resolveMetadata'],

            ]];

        $config['fields'] = $fields;

        return;
    }
}
