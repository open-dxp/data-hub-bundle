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

namespace OpenDxp\Tests\Model\DataObject;

use OpenDxp\Bundle\DataHubBundle\Configuration;
use OpenDxp\Tests\Support\Helper\DataType\TestDataHelper;
use OpenDxp\Tests\Support\Test\ModelTestCase;

/**
 * Class ListingTest
 *
 * @package Pimcore\Tests\Model\DataObject
 *
 * @group model.dataobject.listing
 */
class ImportingConfigTest extends ModelTestCase
{
    /**
     * @var TestDataHelper
     */
    protected $testDataHelper;

    const CORRECT_API_KEY = 'correct_key';

    const CONFNAME = 'newone';

    public function setUp(): void
    {
        parent::setUp();
        //TestHelper::cleanUp();
        //$this->prepareData();
    }

    public function tearDown(): void
    {
        //TestHelper::cleanUp();
        //        parent::tearDown();
    }

    public function testConfiguration()
    {

        $config = Configuration::getByName(self::CONFNAME);
        $this->assertEquals(false, $config instanceof Configuration, 'Check if configuration exists ' . self::CONFNAME);

        $config = new Configuration('graphql', '/124', self::CONFNAME);

        $configurationData = file_get_contents(__DIR__ . '/../_support/Resources/configuration_query_mutation_allowed.json');
        $decodedConfigurationData = json_decode($configurationData, true);
        $config->setConfiguration($decodedConfigurationData);

        $config->save();
        $config = Configuration::getByName(self::CONFNAME);

        //this works locally but not on github actions
        $this->assertEquals(true, $config instanceof Configuration, 'Check if configuration is successfully saved ' . self::CONFNAME . ': ' . print_r($config, true));
    }
}
