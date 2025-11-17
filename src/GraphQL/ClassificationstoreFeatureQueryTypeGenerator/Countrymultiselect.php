<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureQueryTypeGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureType\MultiselectType;

class Countrymultiselect extends Base
{
    /**
     * @return MultiselectType
     *
     * @throws \Exception
     */
    public function getFieldType()
    {
        return MultiselectType::getInstance($this->getGraphQlService(), 'csFeatureCountryMultiselect', 'countries');
    }
}
