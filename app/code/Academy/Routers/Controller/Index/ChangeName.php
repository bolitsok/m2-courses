<?php

namespace Academy\Routers\Controller\Index;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Customer\Model\Session;

class ChangeName extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $session;

    public function __construct(
        Context $context,
        Session $session,
        PageFactory $resultPageFactory
    ){
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->session = $session;
    }

    public function execute()
    {
        if($this->session->isLoggedIn()) {
            $resultPage = $this->resultPageFactory->create();

            return $resultPage;
        } else {
            $this->session->authenticate();
        }
    }
}