<?php

declare(strict_types=1);

/**
 * OpenDXP
 *
 * This source file is licensed under the GNU General Public License version 3 (GPLv3).
 *
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) Pimcore GmbH (https://pimcore.com)
 * @copyright  Modification Copyright (c) OpenDXP (https://www.opendxp.io)
 * @license    https://www.gnu.org/licenses/gpl-3.0.html  GNU General Public License version 3 (GPLv3)
 */

namespace OpenDxp\Bundle\DataHubBundle\Tests\Feature\Configuration;

use OpenDxp\Bundle\DataHubBundle\Configuration;

it('saves a configuration and finds it by its name', function () {
    $name = uniqid('datahub');
    $fixture = (string) file_get_contents(dirname(__DIR__, 2) . '/Fixtures/configurations/query-and-mutation.json');
    $configuration = new Configuration('graphql', '/', $name);
    $configuration->setConfiguration(json_decode($fixture, true));

    $configuration->save();

    expect(Configuration::getByName($name)?->getQueryEntities())->toBe(['DataHubTestEntity']);
});
