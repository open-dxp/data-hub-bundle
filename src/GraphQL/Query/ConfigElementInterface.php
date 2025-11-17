<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Query;

use GraphQL\Type\Definition\ResolveInfo;
use OpenDxp\Model\Element\ElementInterface;

interface ConfigElementInterface
{
    /**
     * @return string
     */
    public function getLabel();

    /**
     * @param ElementInterface|null $element
     *
     * @return \stdClass|null
     */
    public function getLabeledValue($element, ResolveInfo $resolveInfo = null);
}
