<?php

namespace Academy\Routers\Controller\Index;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;

class Success extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ){
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        return $resultPage;
    }
}