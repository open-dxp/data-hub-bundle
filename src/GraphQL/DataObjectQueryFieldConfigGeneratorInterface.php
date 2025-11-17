<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL;

use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

interface DataObjectQueryFieldConfigGeneratorInterface
{
    /**
     * @param string $columnConfig
     * @param ClassDefinition $class
     * @param object $container
     *
     * @return mixed
     */
    public function getGraphQlFieldConfig($columnConfig, Data $fieldDefinition, $class, $container);

    /**
     * @param ClassDefinition|null $class
     * @param object|null $container
     *
     * @return mixed
     */
    public function getFieldType(Data $fieldDefinition, $class = null, $container = null);

    /**
     * @param string $attribute
     * @param Data|null $fieldDefinition
     * @param ClassDefinition|null $class
     *
     * @return array|callable(mixed $value, array $args, array $context, \GraphQL\Type\Definition\ResolveInfo $info): mixed
     */
    public function getResolver($attribute, $fieldDefinition, $class);
}
