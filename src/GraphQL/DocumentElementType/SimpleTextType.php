<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use OpenDxp\Model\Document\Editable\Table;

class SimpleTextType extends ObjectType
{
    protected static $instance;

    /**
     * @param string $name
     *
     * @return array
     */
    public static function getStandardConfig($name)
    {
        return [
            'name' => $name,
            'fields' => [
                '_editableName' => [
                    'type' => Type::string(),
                    'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                        if ($value) {
                            return $value->getName();
                        }
                    },
                ],
                '_editableType' => [
                    'type' => Type::string(),
                    'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                        if ($value) {
                            return $value->getType();
                        }
                    },
                ],
                'text' => [
                    'type' => Type::string(),
                    'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                        if ($value) {
                            if ($value instanceof Table) {
                                if ($value->getData()) {
                                    return json_encode($value->getData());
                                }
                            } else {
                                return $value->getData();
                            }
                        }
                    },
                ],
            ],
        ];
    }
}
