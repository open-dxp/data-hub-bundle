<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectQueryFieldConfigGenerator;

use GraphQL\Type\Definition\Type;
use OpenDxp\Model\DataObject\ClassDefinition\Data;

class UrlSlug extends Base
{
    public function getFieldType(Data $fieldDefinition, $class = null, $container = null)
    {
        return Type::listOf($this->getGraphQlService()->getDataObjectTypeDefinition('url_slug'));
    }
}
