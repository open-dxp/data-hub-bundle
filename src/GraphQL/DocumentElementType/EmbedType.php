<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use OpenDxp\Model\Document\Editable\Date;
use OpenDxp\Model\Document\Editable\Embed;

class EmbedType extends ObjectType
{
    protected static $instance;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            $config =
                [
                    'name' => 'document_editableEmbed',
                    'fields' => [
                        '_editableName' => [
                            'type' => Type::string(),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value instanceof Date) {
                                    return $value->getName();
                                }
                            },
                        ],
                        '_editableType' => [
                            'type' => Type::string(),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value instanceof Date) {
                                    return $value->getType();
                                }
                            },
                        ],
                        'url' => [
                            'type' => Type::string(),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value instanceof Embed) {
                                    return $value->getUrl();
                                }
                            },
                        ],
                    ],
                ];
            self::$instance = new static($config);
        }

        return self::$instance;
    }
}
