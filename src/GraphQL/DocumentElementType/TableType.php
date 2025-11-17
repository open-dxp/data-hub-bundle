<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType;

class TableType extends SimpleTextType
{
    protected static $instance;

    /**
     * @return static
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            $config = self::getStandardConfig('document_editableTable');
            self::$instance = new static($config);
        }

        return self::$instance;
    }
}
