<?php

/**
 * OpenDXP
 *
 * This source file is licensed under the GNU General Public License version 3 (GPLv3).
 *
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) Pimcore GmbH (https://pimcore.com)
 * @copyright  Modification Copyright (c) OpenDXP (https://www.opendxp.ch)
 * @license    https://www.gnu.org/licenses/gpl-3.0.html  GNU General Public License version 3 (GPLv3)
 */

namespace OpenDxp\Bundle\DataHubBundle\GraphQL\DocumentElementMutationFieldConfigGenerator;

use OpenDxp\Bundle\DataHubBundle\GraphQL\Service;
use OpenDxp\Bundle\DataHubBundle\GraphQL\Traits\ServiceTrait;

class Base
{
    use ServiceTrait;

    public function __construct(Service $graphQlService)
    {
        $this->setGraphQLService($graphQlService);
    }

    public function getDocumentElementMutationFieldConfig()
    {
        throw new \Exception("needs to be implemented in the base class. let's see, maybe there are similarities");
    }
}
