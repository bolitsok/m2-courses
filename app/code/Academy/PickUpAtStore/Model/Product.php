<?php

namespace Academy\PickUpAtStore\Model;

class Product extends \Magento\Framework\Model\AbstractModel implements \Academy\PickUpAtStore\Api\Data\ProductInterface,
    \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'academy_pickupatstore_product';
    protected $_cacheTag = 'academy_pickupatstore_product';
    protected $_eventPrefix = 'academy_pickupatstore_product';

    protected function _construct()
    {
        $this->_init('Academy\PickUpAtStore\Model\ResourceModel\Product');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    public function getProductId()
    {
        return $this->getData(self::PRODUCT_ID);
    }

    public function setProductId($productId)
    {
        return $this->setData(self::PRODUCT_ID, $productId);
    }

    public function getShopId()
    {
        return $this->getData(self::SHOP_ID);
    }

    public function setShopId($shopId)
    {
        return $this->setData(self::SHOP_ID, $shopId);
    }

    public function getQty()
    {
        return $this->getData(self::QTY);
    }

    public function setQty($qty)
    {
        return $this->setData(self::QTY, $qty);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}