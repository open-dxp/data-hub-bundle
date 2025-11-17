<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\TypeInterface;

use GraphQL\Type\Definition\InterfaceType;
use GraphQL\Type\Definition\Type;

class Element
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
                        'name' => 'element',
                        'fields' => [
                            'id' => [
                                'type' => Type::id(),
                            ],
                        ],
                    ]
                );
        }

        return self::$instance;
    }
}
