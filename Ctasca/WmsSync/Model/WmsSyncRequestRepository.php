<?php
declare(strict_types=1);

namespace Ctasca\WmsSync\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Ctasca\WmsSync\Api\Data\WmsSyncRequestInterface;
use Ctasca\WmsSync\Api\Data\WmsSyncRequestSearchResultInterface;
use Ctasca\WmsSync\Api\WmsSyncRequestRepositoryInterface;
use Ctasca\WmsSync\Model\ResourceModel\WmsSyncRequest as WmsSyncRequestResource;
use Ctasca\WmsSync\Model\ResourceModel\WmsSyncRequest\CollectionFactory as WmsSyncRequestCollectionFactory;

class WmsSyncRequestRepository implements WmsSyncRequestRepositoryInterface
{
    public function __construct(
        private readonly WmsSyncRequestResource $wmsSyncRequestResource,
        private readonly WmsSyncRequestFactory $wmsSyncRequestFactory,
        private readonly WmsSyncRequestCollectionFactory $wmsSyncRequestCollectionFactory,
        private readonly CollectionProcessorInterface $collectionProcessor,
        private readonly WmsSyncRequestSearchResultInterface $wmsSyncRequestSearchResult
    ){}

    /**
     * @param int $id
     * @return WmsSyncRequestInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): WmsSyncRequestInterface
    {
        /** @var \Ctasca\WmsSync\Model\WmsSyncRequest $wmsSyncRequest */
        $wmsSyncRequest = $this->wmsSyncRequestFactory->create();
        $this->wmsSyncRequestResource->load($wmsSyncRequest, $id);
        if (!$wmsSyncRequest->getRequestId()) {
            throw new NoSuchEntityException(__('Entity with id "%1" does not exist.', $id));
        }

        return $wmsSyncRequest;
    }

    /**
     * @param WmsSyncRequestInterface $wmsSyncRequest
     * @return WmsSyncRequestInterface
     * @throws CouldNotSaveException
     */
    public function save(WmsSyncRequestInterface $wmsSyncRequest): WmsSyncRequestInterface
    {
        try {
            $this->wmsSyncRequestResource->save($wmsSyncRequest);
            return $wmsSyncRequest;
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save: %1', $e->getMessage()));
        }
    }

    /**
     * @param WmsSyncRequestInterface $wmsSyncRequest
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(WmsSyncRequestInterface $wmsSyncRequest): bool
    {
        try {
            $this->wmsSyncRequestResource->delete($wmsSyncRequest);
            return true;
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Could not delete: %1', $e->getMessage()));
        }
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return WmsSyncRequestSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): WmsSyncRequestSearchResultInterface
    {
        $collection = $this->wmsSyncRequestCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $this->wmsSyncRequestSearchResult->setSearchCriteria($searchCriteria);
        $items = $collection->getItems();
        $this->wmsSyncRequestSearchResult->setItems($items);
        $this->wmsSyncRequestSearchResult->setTotalCount($collection->getSize());
        return $this->wmsSyncRequestSearchResult;
    }
}
