<?php

namespace Academy\Lesson8\Plugin;

use Academy\Lesson8\Helper\Data;

class BeforeProductAdd
{
    protected $helper;


    public function __construct(
        Data $helper
    ){
        $this->helper = $helper;
    }

    public function beforeAddProduct(\Magento\Quote\Model\Quote $subject, \Magento\Catalog\Model\Product $product){
        $productPrice = $product->getData('price');

        if($this->helper->isEnablePriceFilter() && $productPrice < $this->helper->getHidePriceLower()){
            throw new \Magento\Framework\Exception\LocalizedException(
                __('Product that you are trying to add is not available.')
            );
        }
    }

}