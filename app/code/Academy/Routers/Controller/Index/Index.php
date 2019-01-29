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
            $resultPage = $this->resultPageFactory->create();

            return $resultPage;
        } else {
            $this->session->authenticate();
        }
    }

}