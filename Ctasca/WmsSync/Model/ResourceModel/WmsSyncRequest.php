<?php
declare(strict_types=1);

namespace Ctasca\WmsSync\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class WmsSyncRequest extends AbstractDb
{
    /** @var string Main table name */
    const MAIN_TABLE = 'wms_sync_request';

    /** @var string Main table primary key field name */
    const ID_FIELD_NAME = 'request_id';

    protected function _construct(): void
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}