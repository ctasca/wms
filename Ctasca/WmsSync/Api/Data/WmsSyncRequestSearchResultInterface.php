<?php
declare(strict_types=1);

namespace Ctasca\WmsSync\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Api\SearchResults;

interface WmsSyncRequestSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return WmsSyncRequestInterface[]
     */
    public function getItems();

    /**
     * @param WmsSyncRequestInterface[] $items
     * @return $this
     */
    public function setItems(array $items);

    /**
     * @param int $totalCount
     * @return $this
     */
    public function setTotalCount($totalCount);
}
