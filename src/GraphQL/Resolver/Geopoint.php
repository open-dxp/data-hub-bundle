<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Resolver;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\Model\DataObject\Data\GeoCoordinates;

class Geopoint
{
    use ServiceTrait;

    /**
     * @param mixed $value
     * @param array $args
     * @param array $context
     *
     * @return float|null
     *
     * @throws \Exception
     */
    public function resolveLongitude($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null)
    {
        if ($value instanceof GeoCoordinates) {
            return $value->getLongitude();
        }

        return null;
    }

    /**
     * @param mixed $value
     * @param array $args
     * @param array $context
     *
     * @return float|null
     *
     * @throws \Exception
     */
    public function resolveLatitude($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null)
    {
        if ($value instanceof GeoCoordinates) {
            return $value->getLatitude();
        }

        return null;
    }
}
