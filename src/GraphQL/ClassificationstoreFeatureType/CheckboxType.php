<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\FeatureDescriptor;
use OpenDxp\Bundle\DataHubBundle\GraphQL\TypeInterface\CsFeature;

class CheckboxType extends ObjectType
{
    protected static $instance;

    /**
     * @return CheckboxType
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $fields = Helper::getCommonFields();
            $fields['checked'] = [
                'type' => Type::boolean(),
                'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                    if ($value instanceof FeatureDescriptor) {
                        return $value->getValue();
                    }
                },
            ];

            $config =
                [
                    'name' => 'csFeatureCheckbox',
                    'interfaces' => [CsFeature::getInstance()],
                    'fields' => $fields,

                ];
            self::$instance = new static($config);
        }

        return self::$instance;
    }
}
