<?php

namespace Academy\PickUpAtStore\Observer;

use Magento\Framework\Event\ObserverInterface;

class ProductSaveAfter implements ObserverInterface
{
    protected $request;

    public function __construct(
        \Magento\Framework\App\RequestInterface $request
    )
    {
        $this->request = $request;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $post = $this->request->getPostValue();
        $product = $post['product'];
        
        // TODO
    }
}