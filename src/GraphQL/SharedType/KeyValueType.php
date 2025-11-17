<?php
declare(strict_types=1);


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\SharedType;

use GraphQL\Type\Definition\InputObjectType;
use GraphQL\Type\Definition\Type;

class KeyValueType extends InputObjectType
{
    /**
     * @var static|null
     */
    protected static $instance;

    /**
     * @return KeyValueType
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            $config = [
                'name' => 'KeyValue',
                'fields' => [
                    'key' => Type::string(),
                    'value' => Type::string(),
                ],
            ];
            self::$instance = new static($config);
        }

        return self::$instance;
    }

    /**
     *
     * @return array
     */
    public static function resolveAssociativeArray(?array $value)
    {
        if (null === $value) {
            return [];
        }

        $res = [];

        foreach ($value as $entry) {
            $res[$entry['key']] = $entry['value'];
        }

        return $res;
    }
}
