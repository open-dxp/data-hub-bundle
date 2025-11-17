<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType\LinkType;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

class Link extends Base
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
            'columnConfig' => $attribute,
            'name' => $fieldDefinition->getName(),
            'type' => $this->getFieldType($fieldDefinition, $class, $container),
        ], $container);
    }

    /**
     * @param ClassDefinition|null $class
     * @param object|null $container
     *
     * @return LinkType
     */
    public function getFieldType(Data $fieldDefinition, $class = null, $container = null)
    {
        return LinkType::getInstance();
    }
}
