<?php


namespace OpenDxp\Bundle\DataHubBundle;

use GraphQL\Error\ClientAware;

class MySafeException extends \Exception implements ClientAware
{
    /**
     * @var string|null
     */
    protected $category;

    /**
     * @param string|null $category
     * @param string $message
     * @param int $code
     */
    public function __construct($category = null, $message = '', $code = 0, \Throwable $previous = null)
    {
        $this->category = $category;
        parent::__construct($message, $code, $previous);
    }

    public function isClientSafe(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category ? $this->category : 'datahub';
    }
}
