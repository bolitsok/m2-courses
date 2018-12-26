<?php

namespace Academy\Routers\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Model\Session;


class BlockIndex extends \Magento\Framework\View\Element\Template
{
    protected $session;

    public function __construct(
        Context $context,
        Session $session
    )
    {
        $this->session = $session;
        parent::__construct($context);
    }

    public function getCustomerName(){
        $customerName = $this->session->getCustomer()->getname();

        return $customerName;
    }
}
