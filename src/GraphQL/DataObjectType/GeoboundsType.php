<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType;

use GraphQL\Type\Definition\ObjectType;

class GeoboundsType extends ObjectType
{
    protected static $instance;

    /**
     * @return static
     */
    public static function getInstance()
    {
        $resolver = new \OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver\Geobounds();
        if (!self::$instance) {
            $config =
                [
                    'fields' => [
                        'northEast' => [
                            'type' => GeopointType::getInstance(),
                            'resolve' => [$resolver, 'resolveNorthEast'],
                        ],
                        'southWest' => [
                            'type' => GeopointType::getInstance(),
                            'resolve' => [$resolver, 'resolveSouthWest'],
                        ],

                    ],
                ];
            self::$instance = new static($config);
        }

        return self::$instance;
    }
}
