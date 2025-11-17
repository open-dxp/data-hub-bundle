<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\FeatureDescriptor;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\TypeInterface\CsFeature;

class MultiselectType extends ObjectType
{
    protected static $instance = [];

    /**
     * @param string $fieldname
     *
     * @return MultiselectType
     *
     */
    public static function getInstance(Service $service, string $name, $fieldname = 'selections')
    {
        if (!isset(self::$instance[$name])) {
            $fields = Helper::getCommonFields();
            $fields[$fieldname] = [
                'type' => Type::listOf(Type::string()),
                'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                    if ($value instanceof FeatureDescriptor) {
                        return $value->getValue();
                    }
                },
            ];

            $config =
                [
                    'name' => $name,
                    'interfaces' => [CsFeature::getInstance()],
                    'fields' => $fields,
                ];
            self::$instance[$name] = new static($config);
        }

        return self::$instance[$name];
    }
}
