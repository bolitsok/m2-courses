<?php

namespace Academy\Routers\Block\Account\Dashboard;

class Info extends \Magento\Customer\Block\Account\Dashboard\Info
{
    protected $scopeConfig;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Helper\Session\CurrentCustomer $currentCustomer,
        \Magento\Newsletter\Model\SubscriberFactory $subscriberFactory,
        \Magento\Customer\Helper\View $helperView
    ) {
        $this->scopeConfig = $context->getScopeConfig();
        parent::__construct($context, $currentCustomer, $subscriberFactory, $helperView);
    }

    public function getSubscribeText(){
        $text = $this->scopeConfig->getValue('academy_general/subscribe/subscribe_text', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);

        return $text ? $text : 'You aren\'t subscribed to our newsletter.';
    }
}