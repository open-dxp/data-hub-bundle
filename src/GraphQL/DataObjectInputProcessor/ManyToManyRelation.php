<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ElementIdentificationTrait;
use OpenDxp\Model\DataObject\Concrete;
use OpenDxp\Model\DataObject\Fieldcollection\Data\AbstractData;
use OpenDxp\Model\Exception\NotFoundException;

class ManyToManyRelation extends Base
{
    use ElementIdentificationTrait;

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
            $result = [];
            if (is_array($newValue)) {
                foreach ($newValue as $newValueItemKey => $newValueItemValue) {
                    $element = $this->getElementByTypeAndIdOrPath($newValueItemValue);

                    if ($element) {
                        $result[] = $element;
                    } else {
                        throw new NotFoundException(
                            sprintf('Element with id %s or fullpath %s not found',
                                $newValueItemValue['id'],
                                $newValueItemValue['fullpath']
                            )
                        );
                    }
                }
            }

            return $container->$setter($result);
        });
    }
}
