<?php

namespace Academy\PickUpAtStore\Model\ResourceModel\Product;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init('Academy\PickUpAtStore\Model\Product', 'Academy\PickUpAtStore\Model\ResourceModel\Product');
    }
}