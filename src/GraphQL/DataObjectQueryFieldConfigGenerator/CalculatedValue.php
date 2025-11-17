<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator;

use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

/**
 * Class CalculatedValue
 *
 * @package OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator
 */
class CalculatedValue extends Base
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
        return $this->enrichConfig(
            $fieldDefinition,
            $class,
            $attribute,
            [
                'name' => $fieldDefinition->getName(),
                'type' => $this->getFieldType($fieldDefinition, $class, $container),
                'description' => $fieldDefinition->getTooltip(),
            ],
            $container
        );
    }
}
