<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType\HrefType;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

class Href extends Base
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
            'resolve' => $this->getResolver($attribute, $fieldDefinition, $class),
        ], $container);
    }

    /**
     * @param ClassDefinition|null $class
     * @param object|null $container
     *
     * @return HrefType
     */
    public function getFieldType(Data $fieldDefinition, $class = null, $container = null)
    {
        return new HrefType($this->getGraphQlService(), $fieldDefinition, $class, ['description' => 'pseudo class for field ' . $fieldDefinition->getName()]);
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
        $resolver = new Helper\Href($this->getGraphQlService(), $attribute, $fieldDefinition, $class);

        return [$resolver, 'resolve'];
    }
}
