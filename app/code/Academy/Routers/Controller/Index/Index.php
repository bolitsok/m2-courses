<?php

namespace Academy\Routers\Controller\Index;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $session;

    protected $resultPageFactory;

    public function __construct(
        Session $session,
        PageFactory $resultPageFactory,
        Context $context
    )
    {
        $this->session = $session;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        if($this->session->isLoggedIn()){
            $customerName = $this->session->getCustomer()->getname();
            $resultPage = $this->resultPageFactory->create();

            $block = $resultPage->getLayout()->getBlock('customername');
            $block->setCustomerName($customerName);

            $this->_view->loadLayout();
            $this->_view->renderLayout();
        } else {
            $this->session->authenticate();
        }
    }

}