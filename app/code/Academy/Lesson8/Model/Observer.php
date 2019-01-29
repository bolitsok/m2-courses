<?php

namespace Academy\Lesson8\Model;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\NotFoundException;
use Academy\Lesson8\Helper\Data;

class Observer implements ObserverInterface
{
    protected $helper;

    public function __construct(
        Data $helper
    ){
        $this->helper = $helper;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $productId = $observer->getRequest()->getParam('id');
        $productPrice = $this->helper->getProductPrice($productId);

        if($this->helper->isEnablePriceFilter() && $productPrice < $this->helper->getHidePriceLower()){
            throw new NotFoundException(__('Page not found.'));
        }
    }
}
