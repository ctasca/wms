<?php
declare(strict_types=1);

namespace Ctasca\WmsSync\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Ctasca\WmsSync\Api\Data\WmsSyncRequestInterface;
use Ctasca\WmsSync\Api\Data\WmsSyncRequestSearchResultInterface;

interface WmsSyncRequestRepositoryInterface
{
    /**
     * @param $id
     * @return WmsSyncRequestInterface
     * @throws NoSuchEntityException
     */
    public function getById($id): WmsSyncRequestInterface;

    /**
     * @param WmsSyncRequestInterface $wmsSyncRequest
     * @return WmsSyncRequestInterface
     */
    public function save(WmsSyncRequestInterface $wmsSyncRequest): WmsSyncRequestInterface;

    /**
     * @param WmsSyncRequestInterface $wmsSyncRequest
     * @return bool
     */
    public function delete(WmsSyncRequestInterface $wmsSyncRequest): bool;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return WmsSyncRequestSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): WmsSyncRequestSearchResultInterface;
}
