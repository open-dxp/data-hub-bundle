<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\TypeInterface;

use GraphQL\Type\Definition\InterfaceType;
use GraphQL\Type\Definition\Type;

class Property
{
    public static $instance;

    /**
     * @return InterfaceType
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance =
                new InterfaceType(
                    [
                        'name' => 'property',
                        'fields' => [
                            'name' => [
                                'type' => Type::string(),        // name of property
                            ],
                            'type' => [
                                'type' => Type::string(),        // property type
                            ],
                        ],
                    ]

                );
        }

        return self::$instance;
    }
}
