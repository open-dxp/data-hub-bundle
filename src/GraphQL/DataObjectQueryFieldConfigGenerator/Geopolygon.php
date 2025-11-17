<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator;

use GraphQL\Type\Definition\ListOfType;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType\GeopointType;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

class Geopolygon extends Base
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
        return $this->enrichConfig($fieldDefinition, $class, $attribute, [
            'name' => $fieldDefinition->getName(),
            'type' => $this->getFieldType($fieldDefinition, $class, $container),
        ], $container);
    }

    /**
     * @param ClassDefinition|null $class
     * @param object|null $container
     *
     * @return ListOfType
     */
    public function getFieldType(Data $fieldDefinition, $class = null, $container = null)
    {
        return Type::listOf(GeopointType::getInstance());
    }
}
