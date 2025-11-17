<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Model\DataObject\Concrete;
use OpenDxp\Model\DataObject\Fieldcollection\Data\AbstractData;

class ExternalImage extends Base
{
    /**
     * @param Concrete|AbstractData $object
     * @param string $newValue
     * @param array $args
     * @param array $context
     *
     * @throws \Exception
     */
    public function process($object, $newValue, $args, $context, ResolveInfo $info)
    {
        $attribute = $this->getAttribute();
        Service::setValue($object, $attribute, function ($container, $setter) use ($newValue) {
            $image = null;
            if ($newValue) {
                $image = new \OpenDxp\Model\DataObject\Data\ExternalImage($newValue);
            }

            return $container->$setter($image);
        });
    }
}
