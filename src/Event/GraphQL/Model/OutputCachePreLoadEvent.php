<?php


namespace OpenDxp\Bundle\DataHubBundle\Event\GraphQL\Model;

use OpenDxp\Event\Traits\RequestAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Contracts\EventDispatcher\Event;

class OutputCachePreLoadEvent extends Event
{
    use RequestAwareTrait;

    /**
     * @var bool
     */
    protected $useCache;

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return bool
     */
    public function isUseCache()
    {
        return $this->useCache;
    }

    public function setUseCache(bool $useCache)
    {
        $this->useCache = $useCache;
    }

    public function __construct(Request $request, bool $useCache)
    {
        $this->request = $request;
        $this->useCache = $useCache;
    }
}
