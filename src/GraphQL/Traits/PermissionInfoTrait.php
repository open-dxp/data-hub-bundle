<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\Traits;

trait PermissionInfoTrait
{
    /**
     * @var bool
     */
    protected $omitPermissionCheck = false;

    /**
     * @return bool
     */
    public function getOmitPermissionCheck()
    {
        return $this->omitPermissionCheck;
    }

    public function setOmitPermissionCheck(bool $omitPermissionCheck)
    {
        $this->omitPermissionCheck = $omitPermissionCheck;
    }
}
