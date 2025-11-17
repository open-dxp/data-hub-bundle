<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\TypeInterface;

use GraphQL\Type\Definition\InterfaceType;
use GraphQL\Type\Definition\Type;

class CsFeature
{
    public static $instance;

    /**
     * Defines fields common to all query types
     *
     * @return InterfaceType
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance =
                new InterfaceType(
                    [
                        'name' => 'csFeatureInterface',
                        'fields' => [
                            'id' => [
                                'type' => Type::int(),
                            ],
                            'name' => [
                                'type' => Type::string(),
                            ],
                            'title' => [
                                'type' => Type::string(),
                            ],
                            'type' => [
                                'type' => Type::string(),
                            ],
                            'description' => [
                                'type' => Type::string(),
                            ],
                        ],
                    ]

                );
        }

        return self::$instance;
    }
}
