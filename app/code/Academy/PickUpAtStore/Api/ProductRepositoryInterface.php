<?php

namespace Academy\PickUpAtStore\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Academy\PickUpAtStore\Api\Data\ProductInterface;

interface ProductRepositoryInterface
{
    public function save(ProductInterface $store);

    public function getById($storeId);

    public function getList(SearchCriteriaInterface $searchCriteria);

    public function delete(ProductInterface $store);

    public function deleteById($storeId);
}