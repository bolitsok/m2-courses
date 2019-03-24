<?php

namespace Academy\PickUpAtStore\Model\Source;

use Academy\PickUpAtStore\Model\StoreRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Academy\PickUpAtStore\Helper\Data;

class Store implements \Magento\Framework\Option\ArrayInterface
{
    private $storeRepository;
    private $searchCriteriaBuilder;
    private $helper;

    public function __construct(
        StoreRepository $storeRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        Data $helper
    ) {
        $this->storeRepository = $storeRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->helper = $helper;
    }

    public function toOptionArray()
    {
        $stores = $this->helper->getAllStores();

        $storeArray = array();

        if(count($stores)){
            foreach ($stores as $store){
                $storeArray[] = [
                    'label' => $store->getName(),
                    'value' => $store->getId(),
                ];
            }
        }

        return $storeArray;
    }
}