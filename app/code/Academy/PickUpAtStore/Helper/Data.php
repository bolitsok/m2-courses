<?php

namespace Academy\PickUpAtStore\Helper;

use Academy\PickUpAtStore\Model\StoreRepository;
use Academy\PickUpAtStore\Model\Store;
use Academy\PickUpAtStore\Model\ProductRepository;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Store\Model\ScopeInterface;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $storeRepository;
    protected $store;
    protected $productRepository;
    protected $searchCriteriaBuilder;

    public function __construct(
        StoreRepository $storeRepository,
        Store $store,
        ProductRepository $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Context $context
    )
    {
        $this->storeRepository = $storeRepository;
        $this->store = $store;
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context);
    }

    public function getStores($productId)
    {        
        $this->searchCriteriaBuilder->addFilter('product_id', $productId, 'eq');
        $searchCriteria = $this->searchCriteriaBuilder->create();

        $collection = $this->productRepository->getList($searchCriteria)->getItems();
        
        if(count($collection) > 0){
            return true;
        }
        
        return false;
    }

    public function getFastDeliveryStore($cartItems)
    {
        foreach($cartItems as $key => $item){
            $this->searchCriteriaBuilder->addFilter('product_id', $item->getProductId(), 'eq');
            $this->searchCriteriaBuilder->addFilter('qty', $item->getQty(), 'gteq');
            $searchCriteria = $this->searchCriteriaBuilder->create();

            $productShopCollection = $this->productRepository->getList($searchCriteria)->getItems();

            foreach ($productShopCollection as $productShop) {
                $storeId[] = $productShop->getShopId();
                $temp[] = $productShop->getShopId();
            }

            if($key == 0){
                $fastDeliveryStore = $temp;
            }

            $fastDeliveryStore = array_intersect($fastDeliveryStore, $temp);
            unset($temp);
        }

        return $fastDeliveryStore;
    }

    public function getAllStores()
    {
        $this->searchCriteriaBuilder->addFilter('isActive', 1, 'eq');
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $storeCollection = $this->storeRepository->getList($searchCriteria)->getItems();

        return $storeCollection;
    }

    public function getConfigValue($field)
    {
        return $this->scopeConfig->getValue(
            $field, \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
