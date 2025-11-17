<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ElementIdentificationTrait;
use OpenDxp\Model\DataObject\Concrete;
use OpenDxp\Model\DataObject\Fieldcollection\Data\AbstractData;
use OpenDxp\Model\Exception\NotFoundException;

class ManyToOneRelation extends Base
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
    public function process($object, $newValue, $args, $context, ResolveInfo $info): void
    {
        $attribute = $this->getAttribute();
        $me = $this;
        Service::setValue($object, $attribute, function ($container, $setter) use ($newValue) {
            $element = null;

            if (is_array($newValue)) {
                $element = $this->getElementByTypeAndIdOrPath($newValue);

                if (!$element) {
                    throw new NotFoundException(
                        sprintf('Element with id %s or fullpath %s not found',
                            $newValue['id'],
                            $newValue['fullpath']
                        )
                    );
                }
            }

            return $container->$setter($element);
        });
    }
}
