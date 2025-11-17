<?php


namespace OpenDxp\Bundle\DataHubBundle\Event\GraphQL\Model;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Mutation\MutationType;
use OpenDxp\Event\Traits\RequestAwareTrait;
use OpenDxp\Event\Traits\ResponseAwareTrait;
use Symfony\Contracts\EventDispatcher\Event;

class MutationTypeEvent extends Event
{
    use RequestAwareTrait;
    use ResponseAwareTrait;

    /**
     * @var MutationType
     */
    protected $mutationType;

    /**
     * @return MutationType
     */
    public function getMutationType()
    {
        return $this->mutationType;
    }

    public function setMutationType(MutationType $mutationType)
    {
        $this->mutationType = $mutationType;
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function setConfig(array $config): void
    {
        $this->config = $config;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    public function setContext(array $context): void
    {
        $this->context = $context;
    }

    /**
     * @var array
     */
    protected $config;

    /**
     * @var array
     */
    protected $context;

    /**
     * @param array $config
     * @param array $context
     */
    public function __construct(MutationType $mutationType, $config, $context)
    {
        $this->mutationType = $mutationType;
        $this->config = $config;
        $this->context = $context;
    }
}
