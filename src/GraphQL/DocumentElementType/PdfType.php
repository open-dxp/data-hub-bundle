<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use OpenDxp\Bundle\DataHubBundle\GraphQL\ElementDescriptor;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Model\Document\Editable\Pdf;

class PdfType extends ObjectType
{
    protected static $instance;

    /**
     *
     * @return PdfType
     *
     * @throws \Exception
     */
    public static function getInstance(Service $service)
    {
        if (!self::$instance) {
            $assetType = $service->buildAssetType('asset');

            $config =
                [
                    'name' => 'document_editablePdf',
                    'fields' => [
                        '_editableName' => [
                            'type' => Type::string(),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value) {
                                    return $value->getName();
                                }
                            },
                        ],
                        '_editableType' => [
                            'type' => Type::string(),
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) {
                                if ($value instanceof \OpenDxp\Model\Document\Editable\Numeric) {
                                    return $value->getType();
                                }
                            },
                        ],
                        'pdf' => [
                            'type' => $assetType,
                            'resolve' => static function ($value = null, $args = [], $context = [], ResolveInfo $resolveInfo = null) use ($service) {
                                if ($value instanceof Pdf) {
                                    $pdfAsset = $value->getElement();
                                    if ($pdfAsset) {
                                        $data = new ElementDescriptor($pdfAsset);
                                        $service->extractData($data, $pdfAsset, $args, $context, $resolveInfo);

                                        return $data;
                                    }
                                }

                                return  null;
                            },
                        ],
                    ],
                ];
            self::$instance = new static($config);
        }

        return self::$instance;
    }
}
