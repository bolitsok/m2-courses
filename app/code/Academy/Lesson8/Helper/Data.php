<?php

namespace Academy\Lesson8\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Catalog\Model\Product;

class Data extends AbstractHelper
{
    const ENABLE_PRICE_FILTER = 'catalog/test/enable_price_filter';
    const HIDE_PRICE_LOWER = 'catalog/test/hide_price_lower';
    const NEW_CUSTOMER_NOTIFICATION = 'academy_general/new_customer_notification/enable_new_customer_notification';

    protected $_scopeConfig;
    protected $product;

    public function __construct(
        Product $product,
        Context $context
    ) {
        $this->_scopeConfig = $context->getScopeConfig();
        $this->product = $product;
        parent::__construct($context);
    }

    public function isEnablePriceFilter(){
        if($this->_scopeConfig->getValue($this::ENABLE_PRICE_FILTER, \Magento\Store\Model\ScopeInterface::SCOPE_STORE)){
            return true;
        } else {
            return false;
        }
    }

    public function getHidePriceLower(){
        return $this->_scopeConfig->getValue($this::HIDE_PRICE_LOWER, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function getProductPrice($id)
    {
        $product = $this->product->load($id);

        return $product->getData('price');
    }

    public function isNewCustomerNotification(){
        return $this->_scopeConfig->getValue($this::NEW_CUSTOMER_NOTIFICATION, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }


}