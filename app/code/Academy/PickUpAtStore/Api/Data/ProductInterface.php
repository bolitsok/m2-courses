<?php

namespace Academy\PickUpAtStore\Api\Data;

interface ProductInterface
{
    const ENTITY_ID = 'entity_id';
    const PRODUCT_ID = 'product_id';
    const SHOP_ID = 'shop_id';
    const QTY = 'qty';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getEntityId();

    public function getProductId();

    public function setProductId($productId);

    public function getShopId();

    public function setShopId($shopId);

    public function getQty();

    public function setQty($qty);

    public function getCreatedAt();

    public function setCreatedAt($createdAt);

    public function getUpdatedAt();

    public function setUpdatedAt($updatedAt);
}