<?php


namespace OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureQueryTypeGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\ClassificationstoreFeatureType\MultiselectType;

class Multiselect extends Base
{
    /**
     * @return MultiselectType
     *
     * @throws \Exception
     */
    public function getFieldType()
    {
        return MultiselectType::getInstance($this->getGraphQlService(), 'csFeatureMultiselect');
    }
}
