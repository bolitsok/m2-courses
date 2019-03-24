<?php

namespace Academy\PickUpAtStore\Controller\Adminhtml\StoreList;

class Save extends \Magento\Backend\App\Action
{
    private $storeFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Academy\PickUpAtStore\Model\StoreFactory $storeFactory
    ) {
        parent::__construct($context);
        $this->storeFactory = $storeFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('pickupatstore/storelist/add');
            return;
        }
        try {
            $rowData = $this->storeFactory->create();
            $rowData->setData($data);
            if (isset($data['id'])) {
                $rowData->setEntityId($data['id']);
            }
            $rowData->save();
            $this->messageManager->addSuccess(__('Store has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('pickupatstore/storelist/index');
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Academy_PickUpAtStore::save');
    }
}