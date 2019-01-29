<?php

namespace Academy\Routers\Block;

use Magento\Framework\View\Element\Template;

class Back extends \Magento\Framework\View\Element\Template
{
    protected $scopeConfig;

    public function __construct(Template\Context $context)
    {
        $this->scopeConfig = $context->getScopeConfig();
        parent::__construct($context);
    }

    public function enabledInProduct(){
        return $this->scopeConfig->getValue('academy_general/back_link/enable_in_product', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    public function enabledInAccount(){
        return $this->scopeConfig->getValue('academy_general/back_link/enable_in_account', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
