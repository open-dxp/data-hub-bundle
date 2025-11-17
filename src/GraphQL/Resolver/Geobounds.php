<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Model\DataObject\Data\GeoCoordinates;

class Geobounds
{
    use ServiceTrait;

    /**
     * @param mixed $value
     * @param array $args
     * @param array $context
     *
     * @return GeoCoordinates|null
     *
     * @throws \Exception
     */
    public function resolveNorthEast($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null)
    {
        if ($value instanceof \OpenDxp\Model\DataObject\Data\Geobounds) {
            return $value->getNorthEast();
        }

        return null;
    }

    /**
     * @param mixed $value
     * @param array $args
     * @param array $context
     *
     * @return GeoCoordinates|null
     *
     * @throws \Exception
     */
    public function resolveSouthWest($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null)
    {
        if ($value instanceof \OpenDxp\Model\DataObject\Data\Geobounds) {
            return $value->getSouthWest();
        }

        return null;
    }
}
