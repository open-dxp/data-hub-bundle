<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Query\Operator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;
use OpenDxp\DataObject\GridColumnConfig\ConfigElementInterface;

abstract class AbstractOperator implements OperatorInterface
{
    use ServiceTrait;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var array
     */
    protected $context;

    /**
     * @var ConfigElementInterface[]
     */
    protected $children;

    /**
     * @param array|null $context
     */
    public function __construct(array $config = [], $context = null)
    {
        $this->label = $config['label'];
        $this->children = $config['children'];
        $this->context = $context;
    }

    /**
     * @return ConfigElementInterface[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @return bool
     */
    public function expandLocales()
    {
        return false;
    }

    /**
     * @return array|null
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param array $context
     *
     * @return void
     */
    public function setContext($context)
    {
        $this->context = $context;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return void
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
}
