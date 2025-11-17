<?php

declare(strict_types=1);


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Query\Value;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

abstract class AbstractValue implements ValueInterface
{
    use ServiceTrait;

    /**
     * @var string
     */
    protected $attribute;

    /**
     * @var string
     */
    protected $label;

    /** @var string */
    protected $dataType;

    /**
     * @var mixed
     */
    protected $context;

    /**
     * @param array $config
     * @param array|null $context
     */
    public function __construct($config, $context = null)
    {
        $this->attribute = $config['attribute'];
        $this->label = $config['label'];
        $this->context = $context;
        $this->dataType = $config['dataType'];
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }
}
