<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Model\DataObject\Concrete;
use OpenDxp\Model\DataObject\Fieldcollection\Data\AbstractData;

class InputQuantityValue extends Base
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
            if ($newValue) {
                $unit = null;
                if (isset($newValue['unitId'])) {
                    $unit = \OpenDxp\Model\DataObject\QuantityValue\Unit::getById($newValue['unitId']);
                } elseif (isset($newValue['unit'])) {
                    $unit = \OpenDxp\Model\DataObject\QuantityValue\Unit::getByAbbreviation($newValue['unit']);
                }
                $inputQuantityValue = new \OpenDxp\Model\DataObject\Data\InputQuantityValue($newValue['value'], $unit);

                return $container->$setter($inputQuantityValue);
            }

            return null;
        });
    }
}
