<?php

namespace Academy\PickUpAtStore\Model;

use Academy\PickUpAtStore\Api\Data\StoreInterface;
use Academy\PickUpAtStore\Model\StoreFactory;
use Academy\PickUpAtStore\Api\StoreRepositoryInterface;
use Academy\PickUpAtStore\Model\ResourceModel\Store as ResourceStore;
use Academy\PickUpAtStore\Model\ResourceModel\Store\CollectionFactory as StoreCollectionFactory;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class StoreRepository implements StoreRepositoryInterface
{
    protected $resource;
    protected $storeFactory;
    protected $storeCollectionFactory;
    protected $searchResultsFactory;
    protected $collectionProcessor;
    protected $instances = [];

    public function __construct(
        ResourceStore $resource,
        StoreFactory $storeFactory,
        StoreCollectionFactory $storeCollectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ){
        $this->resource = $resource;
        $this->storeFactory = $storeFactory;
        $this->storeCollectionFactory = $storeCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    public function save(StoreInterface $store)
    {
        try {
            $this->resource->save($store);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        unset($this->instances[$store->getId()]);
        return $store;
    }

    public function getById($storeId)
    {
        if (!isset($this->instances[$storeId])) {
            $store = $this->storeFactory->create();
            $this->resource->load($store, $storeId);
            if (!$store->getId()) {
                throw new NoSuchEntityException(__('Store with id "%1" does not exist.', $storeId));
            }
            $this->instances[$storeId] = $store;
        }
        return $this->instances[$storeId];
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->storeCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    public function delete(StoreInterface $store)
    {
        try {
            $storeId = $store->getId();
            $this->resource->delete($store);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        unset($this->instances[$storeId]);

        return true;
    }

    public function deleteById($storeId)
    {
        return $this->delete($this->getById($storeId));
    }
}