<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Model\DataObject\Concrete;
use OpenDxp\Model\DataObject\Fieldcollection\Data\AbstractData;

class Geopoint extends Base
{
    /**
     * @param Concrete|AbstractData $object
     * @param array $newValue
     * @param array $args
     * @param array $context
     *
     * @throws \Exception
     */
    public function process($object, $newValue, $args, $context, ResolveInfo $info)
    {
        $attribute = $this->getAttribute();
        Service::setValue($object, $attribute, function ($container, $setter) use ($newValue) {
            $geoCoordinates = new \OpenDxp\Model\DataObject\Data\GeoCoordinates();
            if ($newValue) {
                $geoCoordinates->setLongitude($newValue['longitude']);
                $geoCoordinates->setLatitude($newValue['latitude']);
            }

            return $container->$setter($geoCoordinates);
        });
    }
}
