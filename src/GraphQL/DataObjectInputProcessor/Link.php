<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DataObjectInputProcessor;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Model\DataObject\Concrete;
use OpenDxp\Model\DataObject\Fieldcollection\Data\AbstractData;

class Link extends Base
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
        Service::setValue($object, $attribute, function ($container, $setter) use ($newValue) {
            if ($newValue === null) {
                return $container->$setter(null);
            }

            if (is_array($newValue)) {
                $tmpLink = new \OpenDxp\Model\DataObject\Data\Link();

                foreach ($newValue as $fieldName => $fieldValue) {
                    $linkSetter = 'set' . ucfirst($fieldName);
                    $tmpLink->{$linkSetter}($fieldValue);
                }

                return $container->$setter($tmpLink);
            }

            return null;
        });
    }
}
