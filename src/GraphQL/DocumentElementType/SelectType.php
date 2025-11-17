<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType;

class SelectType extends SimpleTextType
{
    protected static $instance;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            $config = self::getStandardConfig('document_editableSelect');
            self::$instance = new static($config);
        }

        return self::$instance;
    }
}
