<?php

namespace Academy\Lesson8\Plugin;

use Academy\Lesson8\Helper\Data;

class AroundNewAccount{

    protected $helper;

    public function __construct(
        Data $helper
    ){
        $this->helper = $helper;
    }

    public function aroundNewAccount(
        \Magento\Customer\Model\EmailNotificationInterface $emailNotification,
        callable $proceed,
        \Magento\Customer\Api\Data\CustomerInterface $customer,
        $type = \Magento\Customer\Model\EmailNotificationInterface::NEW_ACCOUNT_EMAIL_REGISTERED,
        $backUrl = '',
        $storeId = 0,
        $sendemailStoreId = null
    ) {

        if($this->helper->isNewCustomerNotification()){
            return $proceed($customer, $type, $backUrl, $storeId, $sendemailStoreId);
        }
    }


}