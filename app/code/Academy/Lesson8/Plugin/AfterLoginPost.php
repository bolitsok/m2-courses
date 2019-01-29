<?php

namespace Academy\Lesson8\Plugin;

use Magento\Customer\Model\Session;
use Magento\Customer\Model\ResourceModel\CustomerRepository;

class AfterLoginPost{

    protected $customerSession;
    protected $customerRepository;

    public function __construct(
        Session $customerSession,
        CustomerRepository $customerRepository
    ){
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
    }

    public function afterExecute(\Magento\Customer\Controller\Account\LoginPost $subject, $result){
        $customerId = $this->customerSession->getCustomerId();
        $customer = $this->customerRepository->getById($customerId);

        if (!$customer->getCustomAttribute('login_number')){
            $customer->setCustomAttribute('login_number', '1');
        } else {
            $customerLoginNumber = $customer->getCustomAttribute('login_number')->getValue();
            $customer->setCustomAttribute('login_number', ($customerLoginNumber + 1));
        }

        $this->customerRepository->save($customer);

        return $result;
    }
}