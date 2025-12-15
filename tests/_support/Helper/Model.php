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

namespace OpenDxp\Bundle\DataHubBundle\Tests\Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Doctrine\DBAL\Exception;
use OpenDxp\Bundle\DataHubBundle\Installer;
use OpenDxp\Tests\Support\Helper\AbstractDefinitionHelper;
use OpenDxp\Tests\Support\Helper\ClassManager;
use OpenDxp\Tests\Support\Helper\OpenDxp;
use OpenDxp\Tests\Support\Util\Autoloader;
use stdClass;

class Model extends AbstractDefinitionHelper
{
    /**
     * @param array $settings
     *
     * @throws Exception
     */
    public function _beforeSuite($settings = []): void
    {
        /** @var Pimcore $pimcoreModule */
        $opendxpModule = $this->getModule('\\' . OpenDxp::class);

        $this->debug('[DataHub] Running datahub installer');

        //create migrations table in order to allow installation - needed for SettingsStoreAware Installer
        \OpenDxp\Db::get()->exec('
        create table migration_versions
        (
            version varchar(1024) not null
                primary key,
            executed_at datetime null,
            execution_time int null
        )
        collate=utf8_unicode_ci;

        ');

        // install datahub bundle
        $installer = $opendxpModule->getContainer()->get(Installer::class);
        $installer->install();

        $this->initializeDefinitions();
        Autoloader::load(DataHubTestEntity::class);
    }

    public function initializeDefinitions(): void
    {
        $cm = $this->getModule('\\' . ClassManager::class);
        $class = $cm->setupClass('DataHubTestEntity', __DIR__ . '/../Resources/class_DataHubTestEntity_import.json');
        $this->prepareData($class);
    }

    /**
     * @param stdClass $class
     *
     * @return void
     */
    public function prepareData($class)
    {
        $seeds = [10, 11, 42, 53, 65, 78, 85];
        $entity = 'OpenDxp\Model\DataObject\\'.$class->name;

        foreach ($seeds as $key => $seed) {
            $object = new $entity();
            $object->setParentId(1);
            $object->setKey('DataHubTest_' . $key);
            $object->setPublished(true);

            $object->save();
        }
    }
}
