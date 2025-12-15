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
 * @copyright  Modification Copyright (c) OpenDXP (https://www.opendxp.io)
 * @license    https://www.gnu.org/licenses/gpl-3.0.html  GNU General Public License version 3 (GPLv3)
 */

namespace OpenDxp\Bundle\DataHubBundle\Tests\Test;

use Codeception\Test\Unit;
use OpenDxp;
use OpenDxp\Tests\Support\Util\TestHelper;

abstract class TestCase extends Unit
{
    /**
     * @var bool
     */
    protected $cleanupDbInSetup = true;

    protected $backupGlobalsExcludeList = ['IDE_EVAL_CACHE'];     // xdebug

    /**
     * Determine if the test needs a DB connection (will be skipped if no DB is present)
     *
     * @return bool
     */
    protected function needsDb()
    {
        return false;
    }

    protected function setUp(): void
    {
        parent::setUp();

        if ($this->needsDb()) {
            TestHelper::checkDbSupport();

            // every single test assumes a clean database
            if ($this->cleanupDbInSetup) {
                TestHelper::cleanUp();
            }
        }

        OpenDxp::collectGarbage();
    }
}
