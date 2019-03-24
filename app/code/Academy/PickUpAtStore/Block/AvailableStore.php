<?php

namespace Academy\PickUpAtStore\Block;

use Academy\PickUpAtStore\Model\ProductRepository;
use Academy\PickUpAtStore\Model\StoreRepository;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;

class AvailableStore extends \Magento\Framework\View\Element\Template
{
    private $productRepository;
    private $storeRepository;
    private $searchCriteriaBuilder;
    private $registry;
    private $product;

    public function __construct(
        Context $context,
        ProductRepository $productRepository,
        StoreRepository $storeRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Registry $registry,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->storeRepository = $storeRepository;
    }

    private function getProduct()
    {
        if (is_null($this->product)) {
            $this->product = $this->registry->registry('product');

            if (!$this->product->getId()) {
                throw new LocalizedException(__('Failed to initialize product'));
            }
        }

        return $this->product;
    }

    public function getAvailableStores()
    {
        $productId = $this->getProduct()->getId();

        $this->searchCriteriaBuilder->addFilter('product_id', $productId, 'eq');
        $searchCriteria = $this->searchCriteriaBuilder->create();

        $collection = $this->productRepository->getList($searchCriteria)->getItems();

        $result = [];

        foreach ($collection as $store) {
            $result[$store->getShopId()] = $store->getQty();
        }

        return $result;
    }

    public function getStores()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();

        $collection = $this->storeRepository->getList($searchCriteria)->getItems();

        return $collection;
    }
}
