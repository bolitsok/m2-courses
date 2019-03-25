<?php

namespace Academy\PickUpAtStore\Block;

use Academy\PickUpAtStore\Model\ProductRepository;
use Academy\PickUpAtStore\Model\StoreRepository;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Academy\PickUpAtStore\Helper\Data;

class AvailableStore extends \Magento\Framework\View\Element\Template
{
    private $productRepository;
    private $storeRepository;
    private $searchCriteriaBuilder;
    private $registry;
    private $product;
    private $_helper;

    public function __construct(
        Context $context,
        ProductRepository $productRepository,
        StoreRepository $storeRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Registry $registry,
        Data $helper,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->storeRepository = $storeRepository;
        $this->_helper = $helper;
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
        return $this->_helper->getAllStores();
    }
}
