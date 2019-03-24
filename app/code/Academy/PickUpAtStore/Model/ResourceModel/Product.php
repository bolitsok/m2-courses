<?php

namespace Academy\PickUpAtStore\Model\ResourceModel;

class Product extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected function _construct()
    {
        $this->_init('product_pickup', 'entity_id');
    }

}