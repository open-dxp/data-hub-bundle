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

namespace OpenDxp\Tests\Test;

use Codeception\Test\Unit;
use OpenDxp;
use OpenDxp\Tests\Support\Helper\DataType\Calculator;
use OpenDxp\Tests\Support\ModelTester;

/**
 * @property ModelTester $tester
 */
abstract class ModelTestCase extends Unit
{
    protected function setUp(): void
    {
        parent::setUp();

        OpenDxp::getContainer()->set('test.calculatorservice', new Calculator());

        if ($this->needsDb()) {
            $this->setUpTestClasses();
        }
    }

    /**
     * Set up test classes before running tests
     */
    protected function setUpTestClasses()
    {
    }

    protected function needsDb()
    {
        return true;
    }
}
