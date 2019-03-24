<?php

namespace Academy\PickUpAtStore\Controller\Adminhtml\StoreList;

class Index extends \Magento\Backend\App\Action
{
    protected $_resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    )
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Academy_PickUpAtStore::storelist');
        $resultPage->getConfig()->getTitle()->prepend(__('Store List'));

        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Academy_PickUpAtStore::storelist');
    }
}