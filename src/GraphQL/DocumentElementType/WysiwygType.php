<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType;

use GraphQL\Type\Definition\Type;
use OpenDxp\Model\Document\Editable\Wysiwyg;

class WysiwygType extends SimpleTextType
{
    protected static $instance;

    /**
     * @return WysiwygType
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            $config = self::getStandardConfig('document_editableWysiwyg');

            $config['fields']['frontend'] = [
                'type' => Type::string(),
                'resolve' => static fn (Wysiwyg $value) => $value->frontend(),
            ];

            self::$instance = new static($config);
        }

        return self::$instance;
    }
}
