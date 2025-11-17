<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class GeopointType extends ObjectType
{
    protected static $instance;

    /**
     * @return static
     */
    public static function getInstance()
    {
        $resolver = new \OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver\Geopoint();
        if (!self::$instance) {
            $config =
                [
                    'fields' => [
                        'longitude' => [
                            'type' => Type::float(),
                            'resolve' => [$resolver, 'resolveLongitude'],
                        ],
                        'latitude' => [
                            'type' => Type::float(),
                            'resolve' => [$resolver, 'resolveLatitude'],
                        ],

                    ],
                ];
            self::$instance = new static($config);
        }

        return self::$instance;
    }
}
