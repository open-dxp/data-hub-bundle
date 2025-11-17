<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor;

use Carbon\Carbon;
use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Model\DataObject\Concrete;
use OpenDxp\Model\DataObject\Fieldcollection\Data\AbstractData;

class Date extends Base
{
    /**
     * @param Concrete|AbstractData $object
     * @param int|string $newValue
     * @param array $args
     * @param array $context
     *
     * @throws \Exception
     */
    public function process($object, $newValue, $args, $context, ResolveInfo $info)
    {
        $attribute = $this->getAttribute();
        Service::setValue($object, $attribute, function ($container, $setter) use ($newValue) {

            if ($newValue === '') {
                $newValue = null;
            }

            if (!is_null($newValue)) {
                if (!is_numeric($newValue)) {
                    $newValue = strtotime($newValue);
                }
                $newValue = Carbon::createFromTimestamp($newValue);
            }

            return $container->$setter($newValue);
        });
    }
}
