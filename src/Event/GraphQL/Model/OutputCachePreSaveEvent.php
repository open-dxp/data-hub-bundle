<?php


namespace OpenDxp\Bundle\DataHubBundle\Event\GraphQL\Model;

use OpenDxp\Event\Traits\RequestAwareTrait;
use OpenDxp\Event\Traits\ResponseAwareTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\EventDispatcher\Event;

class OutputCachePreSaveEvent extends Event
{
    use RequestAwareTrait;
    use ResponseAwareTrait;

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    public function setResponse(Response $response)
    {
        $this->response = $response;
    }

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}
