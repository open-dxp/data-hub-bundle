<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator;

use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType\HrefType;
use OpenDxp\Bundle\DataHubBundle\GraphQL\TypeDefinitionInterface;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

/**
 * Class Multihref
 *
 * @package OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator
 */
class Multihref extends Base implements TypeDefinitionInterface
{
    /**
     * @param string $attribute
     * @param ClassDefinition|null $class
     * @param object|null $container
     *
     * @return array
     */
    public function getGraphQlFieldConfig($attribute, Data $fieldDefinition, $class = null, $container = null)
    {
        return $this->enrichConfig($fieldDefinition, $class, $attribute,
            [
                'name' => $fieldDefinition->getName(),
                'type' => $this->getFieldType($fieldDefinition, $class, $container),
                'resolve' => $this->getResolver($attribute, $fieldDefinition, $class),
            ],
            $container
        );
    }

    /**
     * @param ClassDefinition|null $class
     * @param object|null $container
     *
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function getFieldType(Data $fieldDefinition, $class = null, $container = null)
    {
        return Type::listOf(new HrefType($this->getGraphQlService(), $fieldDefinition, $class));
    }

    /**
     * @param string $attribute
     * @param Data $fieldDefinition
     * @param ClassDefinition $class
     *
     * @return array
     */
    public function getResolver($attribute, $fieldDefinition, $class)
    {
        $resolver = new Helper\Multihref($this->getGraphQlService(), $attribute, $fieldDefinition, $class);

        return [$resolver, 'resolve'];
    }
}
