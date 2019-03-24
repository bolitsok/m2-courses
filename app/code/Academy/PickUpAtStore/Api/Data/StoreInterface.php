<?php

namespace Academy\PickUpAtStore\Api\Data;

interface StoreInterface
{
    const ID = 'id';
    const NAME = 'name';
    const ADDRESS = 'address';
    const CONTACTS = 'contacts';
    const DESCRIPTION = 'description';
    const IS_ACTIVE = 'isActive';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const STORE_ID = 'store_id';

    public function getId();

    public function getName();

    public function setName($name);

    public function getAddress();

    public function setAddress($address);

    public function getContacts();

    public function setContacts($contacts);

    public function getDescription();

    public function setDescription($description);

    public function getIsActive();

    public function setIsActive($isActive);

    public function getCreatedAt();

    public function setCreatedAt($createdAt);

    public function getUpdatedAt();

    public function setUpdatedAt($updatedAt);

    public function getStoreId();

    public function setStoreId($storeId);
}