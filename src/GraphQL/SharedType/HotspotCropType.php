<?php
declare(strict_types=1);


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\SharedType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

/**
 * Class HotspotCropType
 *
 * @package OpenDxp\Bundle\DataHubBundle\GraphQL\SharedType
 */
class HotspotCropType extends ObjectType
{
    /**
     * @var static|null
     */
    protected static $instance;

    /**
     * @return HotspotCropType
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            $config = [
                'fields' => [
                    'cropTop' => Type::float(),
                    'cropLeft' => Type::float(),
                    'cropHeight' => Type::float(),
                    'cropWidth' => Type::float(),
                    'cropPercent' => Type::boolean(),
                ],
            ];
            self::$instance = new static($config);
        }

        return self::$instance;
    }
}
