<?php


namespace OpenDxp\Bundle\DataHubBundle\Configuration\Workspace;

use OpenDxp\Model;

class Dao extends Model\Dao\AbstractDao
{
    const TABLE_NAME_ASSET = 'plugin_datahub_workspaces_asset';

    const TABLE_NAME_DOCUMENT = 'plugin_datahub_workspaces_document';

    const TABLE_NAME_DATAOBJECT = 'plugin_datahub_workspaces_object';

    public function save()
    {
        if ($this->model instanceof Asset) {
            $tableName = self::TABLE_NAME_ASSET;
        } elseif ($this->model instanceof Document) {
            $tableName = self::TABLE_NAME_DOCUMENT ;
        } elseif ($this->model instanceof DataObject) {
            $tableName = self::TABLE_NAME_DATAOBJECT;
        } else {
            throw new \Exception('unknown workspace type');
        }

        $data = [];

        // add all permissions
        $dataRaw = $this->model->getObjectVars();
        foreach ($dataRaw as $key => $value) {
            if (in_array($key, $this->getValidTableColumns($tableName))) {
                if (is_bool($value)) {
                    $value = (int) $value;
                }
                if (!class_exists("\OpenDxp\Db\Connection")) {
                    $key = $this->db->quoteIdentifier($key);
                }
                $data[$key] = $value;
            }
        }
        $this->db->insert($tableName, $data);
    }
}
