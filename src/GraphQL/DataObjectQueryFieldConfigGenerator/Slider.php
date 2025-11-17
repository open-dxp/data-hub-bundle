<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator;

use GraphQL\Type\Definition\Type;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

class Slider extends Base
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
     * @return \GraphQL\Type\Definition\ScalarType|void
     */
    public function getFieldType(Data $fieldDefinition, $class = null, $container = null)
    {
        if ($fieldDefinition instanceof Data\Slider) {
            if ($fieldDefinition->getDecimalPrecision() > 0) {
                return Type::float();
            }

            return Type::int();
        }
    }
}
