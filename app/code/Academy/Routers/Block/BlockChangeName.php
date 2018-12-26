<?php

namespace Academy\Routers\Block;

use Academy\Routers\Helper\Data;

class BlockChangeName extends \Magento\Framework\View\Element\Template
{
    public function getAction(){
        return $this->getUrl(Data::CHANGE_NAME_POST_URL);
    }
}
