<?php

namespace Academy\Routers\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Model\Session;
use Magento\Framework\Message\ManagerInterface;

class ChangeNamePost extends \Magento\Framework\App\Action\Action
{
    protected $customerRepository;

    protected $session;

    protected $messageManager;

    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        Context $context,
        ManagerInterface $messageManager,
        Session $session
    ){
        $this->customerRepository = $customerRepository;
        $this->session = $session;
        $this->messageManager = $messageManager;
        parent::__construct($context);
    }

    public function execute()
    {
        $request = $this->getRequest();

        if ($request) {
            $firstname = $request->getPost('firstname');
            $lastname = $request->getPost('lastname');
        }

        if($firstname && $lastname){
            $customer = $this->customerRepository->getById($this->session->getCustomerId());

            $customer->setFirstname($firstname);
            $customer->setLastname($lastname);

            $this->customerRepository->save($customer);

            $this->messageManager->addSuccess( __('First name and last name changed!') );
            $this->_redirect('*/*/success/');
        } else {
            $this->messageManager->addError( __('Fill all fields') );
            $this->_redirect('*/*/changename/');
        }
    }
}