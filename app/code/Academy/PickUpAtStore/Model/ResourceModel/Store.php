<?php

namespace Academy\PickUpAtStore\Model\ResourceModel;

class Store extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('store_list', 'id');
    }

}