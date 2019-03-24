<?php

namespace Academy\PickUpAtStore\Model\ResourceModel\Store;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';

    protected function _construct()
    {
        $this->_init('Academy\PickUpAtStore\Model\Store', 'Academy\PickUpAtStore\Model\ResourceModel\Store');
    }

}