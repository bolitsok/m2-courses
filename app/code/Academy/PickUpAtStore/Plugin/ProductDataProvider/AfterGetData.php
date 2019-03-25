<?php

namespace Academy\PickUpAtStore\Plugin\ProductDataProvider;

use Magento\Catalog\Ui\DataProvider\Product\Form\ProductDataProvider;
use Magento\Framework\Registry;
use Academy\PickUpAtStore\Model\ProductRepository;
use Magento\Framework\Api\SearchCriteriaBuilder;

class AfterGetData
{
    private $registry;
    private $productRepository;
    private $searchCriteriaBuilder;

    public function __construct(
        Registry $registry,
        ProductRepository $productRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->registry = $registry;
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }
    public function afterGetData(
        ProductDataProvider $subject,
        $result
    ) {
        $productId = $this->registry->registry('product')->getId();

        $this->searchCriteriaBuilder->addFilter('product_id', $productId, 'eq');
        $searchCriteria = $this->searchCriteriaBuilder->create();

        $products = $this->productRepository->getList($searchCriteria)->getItems();

        foreach ($products as $product) {
            // TODO
        }

        return $result;
    }
}