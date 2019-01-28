<?php

namespace Academy\Lesson8\Model\ResourceModel\Fulltext;

class Collection extends \Magento\CatalogSearch\Model\ResourceModel\Fulltext\Collection
{
    function _renderFiltersBefore(){
        if($this->_scopeConfig->getValue('catalog/test/enable_price_filter', \Magento\Store\Model\ScopeInterface::SCOPE_STORE)){
            $price = $this->_scopeConfig->getValue('catalog/test/hide_price_lower', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            $this->addFieldToFilter('price', ['from' => $price]);
        }
        return parent::_renderFiltersBefore();
    }
}