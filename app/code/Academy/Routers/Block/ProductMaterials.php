<?php

namespace Academy\Routers\Block;

use Magento\Framework\View\Element\Template\Context;
use Magento\Catalog\Helper\Data;

class ProductMaterials extends \Magento\Framework\View\Element\Template
{
    protected $helper;

    public function __construct(
        Context $context,
        Data $helper
    ){
        $this->helper = $helper;
        parent::__construct($context);
    }


    public function getProductMaterials(){
        $product = $this->helper->getProduct();
        $materials = $product->getAttributeText('material');
        $materials = implode(", ", $materials);

        return $materials;
    }
}
