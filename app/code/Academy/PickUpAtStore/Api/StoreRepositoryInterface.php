<?php

namespace Academy\PickUpAtStore\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Academy\PickUpAtStore\Api\Data\StoreInterface;

interface StoreRepositoryInterface
{
    public function save(StoreInterface $store);

    public function getById($storeId);

    public function getList(SearchCriteriaInterface $searchCriteria);

    public function delete(StoreInterface $store);

    public function deleteById($storeId);
}