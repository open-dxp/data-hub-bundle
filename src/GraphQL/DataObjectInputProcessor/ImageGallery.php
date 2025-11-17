<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Model\DataObject\Concrete;
use OpenDxp\Model\DataObject\Data\Hotspotimage;
use OpenDxp\Model\DataObject\Fieldcollection\Data\AbstractData;

class ImageGallery extends Base
{
    /**
     * @param Concrete|AbstractData $object
     * @param mixed $newValue
     * @param array $args
     * @param array $context
     *
     * @throws \Exception
     */
    public function process($object, $newValue, $args, $context, ResolveInfo $info)
    {
        $attribute = $this->getAttribute();
        $getter = 'get' . ucfirst($attribute);
        $currentGallery = $object->$getter();

        if ($currentGallery instanceof \OpenDxp\Model\DataObject\Data\ImageGallery) {
            $currentItems = $currentGallery->getItems() ?: [];
        } else {
            $currentItems = [];
        }

        Service::setValue($object, $attribute, function ($container, $setter) use ($newValue, $currentItems) {
            $hotspotImages = [];
            $newGallery = [];

            if ($newValue === null) {
                return $container->$setter($newGallery);
            }

            if (! ($newValue['replace'] ?? false)) {
                foreach ($currentItems as $currentItem) {
                    if ($currentItem instanceof Hotspotimage) {
                        $hotspotImages[] = $currentItem;
                    }
                }
            }

            if (is_array($newValue['images'])) {
                foreach ($newValue['images'] as $imageValue) {
                    $hotspotImage = new Hotspotimage($imageValue['id']);

                    if ($hotspotImage instanceof Hotspotimage) {
                        $hotspotImages[] = $hotspotImage;
                    }
                }

                $newGallery = new \OpenDxp\Model\DataObject\Data\ImageGallery($hotspotImages);
            }

            return $container->$setter($newGallery);
        });
    }
}
