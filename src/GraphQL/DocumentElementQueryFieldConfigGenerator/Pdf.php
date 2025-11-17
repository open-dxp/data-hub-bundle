<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementQueryFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementType\PdfType;

class Pdf extends Base
{
    /**
     * @return PdfType
     */
    public function getFieldType()
    {
        return PdfType::getInstance($this->getGraphQlService());
    }
}
