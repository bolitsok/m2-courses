<?php

namespace Academy\PickUpAtStore\Model;

use Academy\PickUpAtStore\Api\Data\ProductInterface;
use Academy\PickUpAtStore\Model\ProductFactory;
use Academy\PickUpAtStore\Api\ProductRepositoryInterface;
use Academy\PickUpAtStore\Model\ResourceModel\Product as ResourceProduct;
use Academy\PickUpAtStore\Model\ResourceModel\Product\CollectionFactory as ProductCollectionFactory;
use Magento\Framework\Api\SearchResultsInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $resource;
    protected $productFactory;
    protected $productCollectionFactory;
    protected $searchResultsFactory;
    protected $collectionProcessor;
    protected $instances = [];

    public function __construct(
        ResourceProduct $resource,
        ProductFactory $productFactory,
        ProductCollectionFactory $productCollectionFactory,
        SearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ){
        $this->resource = $resource;
        $this->productFactory = $productFactory;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    public function save(ProductInterface $product)
    {
        try {
            $this->resource->save($product);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        unset($this->instances[$product->getEntityId()]);
        return $product;
    }

    public function getById($productId)
    {
        if (!isset($this->instances[$productId])) {
            $product = $this->productFactory->create();
            $this->resource->load($product, $productId);
            if (!$product->getEntityId()) {
                throw new NoSuchEntityException(__('Item store pickup with id "%1" does not exist.', $productId));
            }
            $this->instances[$productId] = $product;
        }
        return $this->instances[$productId];
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->productCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());

        return $searchResults;
    }

    public function delete(ProductInterface $product)
    {
        try {
            $productId = $product->getId();
            $this->resource->delete($product);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        unset($this->instances[$productId]);

        return true;
    }

    public function deleteById($productId)
    {
        return $this->delete($this->getById($productId));
    }
}