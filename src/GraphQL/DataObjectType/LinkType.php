<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class LinkType extends ObjectType
{
    protected static $instance;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            $resolver = new \OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver\Link();
            $config =
                [
                    'fields' => [
                        'text' => [
                            'type' => Type::string(),
                            'resolve' => [$resolver, 'resolveText'],
                        ],
                        'path' => [
                            'type' => Type::string(),
                            'resolve' => [$resolver, 'resolvePath'],
                        ],
                        'target' => [
                            'type' => Type::string(),
                            'resolve' => [$resolver, 'resolveTarget'],
                        ],
                        'anchor' => [
                            'type' => Type::string(),
                            'resolve' => [$resolver, 'resolveAnchor'],
                        ],
                        'title' => [
                            'type' => Type::string(),
                            'resolve' => [$resolver, 'resolveTitle'],
                        ],
                        'accesskey' => [
                            'type' => Type::string(),
                            'resolve' => [$resolver, 'resolveAccesskey'],
                        ],
                        'rel' => [
                            'type' => Type::string(),
                            'resolve' => [$resolver, 'resolveRel'],
                        ],
                        'class' => [
                            'type' => Type::string(),
                            'resolve' => [$resolver, 'resolveClass'],
                        ],
                        'attributes' => [
                            'type' => Type::string(),
                            'resolve' => [$resolver, 'resolveAttributes'],
                        ],
                        'tabindex' => [
                            'type' => Type::string(),
                            'resolve' => [$resolver, 'resolveTabindex'],
                        ],
                        'parameters' => [
                            'type' => Type::string(),
                            'resolve' => [$resolver, 'resolveParameters'],
                        ],
                    ],
                ];
            self::$instance = new static($config);
        }

        return self::$instance;
    }
}
