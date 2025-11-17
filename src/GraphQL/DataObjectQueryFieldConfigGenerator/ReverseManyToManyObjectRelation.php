<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator;

use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\ClassTypeDefinitions;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

class ReverseManyToManyObjectRelation extends Base
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
        /** @var Data\ReverseObjectRelation $fieldDefinition */
        return $this->enrichConfig(
            $fieldDefinition,
            $class,
            $attribute,
            [
                'name' => $fieldDefinition->getName(),
                'type' => $this->getFieldType($fieldDefinition, $class, $container),
                'resolve' => $this->getResolver($attribute, $fieldDefinition, $class),
            ],
            $container
        );
    }

    /**
     * @param Data\ReverseObjectRelation $fieldDefinition
     * @param ClassDefinition|null $class
     * @param object|null $container
     *
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function getFieldType(Data $fieldDefinition, $class = null, $container = null)
    {
        $className = $fieldDefinition->getOwnerClassName();
        $type = Type::listOf(ClassTypeDefinitions::get($className));

        return $type;
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
        $resolver = new \OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator\Helper\ReverseManyToManyObjects($this->getGraphQlService(), $attribute, $fieldDefinition, $class);

        return [$resolver, 'resolve'];
    }
}
