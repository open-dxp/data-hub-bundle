<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL;

abstract class BaseDescriptor extends \ArrayObject
{
    /**
     *
     * ElementDescriptor constructor - an ElementDescriptor describes something that implements
     * the OpenDxp\Model\Element\ElementInterface
     */
    public function __construct()
    {
        parent::__construct([], self::STD_PROP_LIST | self::ARRAY_AS_PROPS);
    }
}
