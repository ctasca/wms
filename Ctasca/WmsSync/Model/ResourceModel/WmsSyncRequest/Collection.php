<?php
declare(strict_types=1);

namespace Ctasca\WmsSync\Model\ResourceModel\WmsSyncRequest;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Ctasca\WmsSync\Model\WmsSyncRequest;
use Ctasca\WmsSync\Model\ResourceModel\WmsSyncRequest as WmsSyncRequestResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct(): void
    {
        $this->_init(WmsSyncRequest::class, WmsSyncRequestResourceModel::class);
    }
}