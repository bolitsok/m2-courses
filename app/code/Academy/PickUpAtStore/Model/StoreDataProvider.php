<?php

namespace Academy\PickUpAtStore\Model;

use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Review\Model\ResourceModel\Review\Product\CollectionFactory;
use Magento\Review\Model\ResourceModel\Review\Product\Collection;
use Magento\Review\Model\Review;


class StoreDataProvider extends AbstractDataProvider
{

    protected $collectionFactory;

    protected $request;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        RequestInterface $request,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collectionFactory = $collectionFactory;
        $this->collection = $this->collectionFactory->create();
        $this->request = $request;
    }


    public function getData()
    {
        $this->getCollection()->addEntityFilter($this->request->getParam('current_product_id', 0))
            ->addStoreData();

        $arrItems = [
            'totalRecords' => $this->getCollection()->getSize(),
            'items' => [],
        ];

        foreach ($this->getCollection() as $item) {
            $arrItems['items'][] = $item->toArray([]);
        }

        return $arrItems;
    }

    public function addFilter(\Magento\Framework\Api\Filter $filter)
    {
        $field = $filter->getField();

        if (in_array($field, ['review_id', 'created_at', 'status_id'])) {
            $filter->setField('rt.' . $field);
        }

        if (in_array($field, ['title', 'nickname', 'detail'])) {
            $filter->setField('rdt.' . $field);
        }

        if ($field === 'review_created_at') {
            $filter->setField('rt.created_at');
        }

        parent::addFilter($filter);
    }
}
