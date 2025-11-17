<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL;

use OpenDxp\Model\DataObject\ClassDefinition;

interface OperatorTypeDefinitionInterface
{
    /**
     * @param array $attributes
     * @param ClassDefinition $class
     * @param object $container
     *
     * @return mixed
     */
    public function getFieldType($attributes, $class, $container);
}
