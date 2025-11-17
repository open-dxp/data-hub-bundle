<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL;

use GraphQL\Type\Definition\Type;
use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

interface TypeDefinitionInterface
{
    /**
     * @param ClassDefinition|null $class
     * @param object|null $container
     *
     * @return Type
     */
    public function getFieldType(Data $fieldDefinition, $class = null, $container = null);
}
