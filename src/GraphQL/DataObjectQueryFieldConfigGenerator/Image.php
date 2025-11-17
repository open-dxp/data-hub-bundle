<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator;

use OpenDxp\Model\DataObject\ClassDefinition;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

class Image extends AssetBase
{
    /**
     * @param string $attribute
     * @param Data $fieldDefinition
     * @param ClassDefinition $class
     *
     * @return array
     */
    public function getResolver($attribute, $fieldDefinition, $class)
    {
        $resolver = new Helper\Image($this->getGraphQlService(), $attribute, $fieldDefinition, $class);

        return [$resolver, 'resolve'];
    }
}
