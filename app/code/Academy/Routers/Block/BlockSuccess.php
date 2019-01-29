<?php

namespace Academy\Routers\Block;

use Magento\Framework\View\Element\Template\Context;
use Academy\Routers\Helper\Data;

class BlockSuccess extends \Magento\Framework\View\Element\Template
{
    protected $helperData;

    public function __construct(
        Context $context,
        Data $helperData
    )
    {
        $this->helperData = $helperData;
        parent::__construct($context);
    }

    public function getChangeNameUrl(){
        return $this->getUrl(Data::CHANGE_NAME_POST_URL);
    }
}
