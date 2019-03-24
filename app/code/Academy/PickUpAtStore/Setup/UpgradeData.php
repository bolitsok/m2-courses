<?php

namespace Academy\PickUpAtStore\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeData implements UpgradeDataInterface
{
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '0.1.1', '<')) {
            $tableName = $setup->getTable('store_list');
            $setup->getConnection()->insertMultiple(
                $tableName, [
                [
                    'name' => 'Globus',
                    'address' => 'Kosmonavta Komarova Ave, 3',
                    'contacts' => '044 555 66 21',
                    'description' => 'Description Globus Store'
                ],
                [
                    'name' => 'Gulliver',
                    'address' => 'Vatutina St, 5',
                    'contacts' => '044 758 62 99',
                    'description' => 'Description Guliver Store'
                ],
                [
                    'name' => 'Kvadrat',
                    'address' => 'Vyborzka St, 12',
                    'contacts' => '056 846 22 66',
                    'description' => 'Description Kvadrat Store'
                ],
                [
                    'name' => 'Ocean Plaza',
                    'address' => 'Smolenska St, 8',
                    'contacts' => '085 675 44 32',
                    'description' => 'Description Ocean Plaza Store'
                ],
            ]);
        }

        if (version_compare($context->getVersion(), '0.1.3', '<')) {
            $tableName = $setup->getTable('product_pickup');
            $setup->getConnection()->insertMultiple(
                $tableName, [
                [
                    'product_id' => '1401',
                    'shop_id' => '1',
                    'qty' => '3'
                ],
                [
                    'product_id' => '1401',
                    'shop_id' => '2',
                    'qty' => '3'
                ],
                [
                    'product_id' => '1401',
                    'shop_id' => '3',
                    'qty' => '5'
                ],
                [
                    'product_id' => '1401',
                    'shop_id' => '4',
                    'qty' => '1'
                ],
                [
                    'product_id' => '1385',
                    'shop_id' => '1',
                    'qty' => '1'
                ],
                [
                    'product_id' => '1385',
                    'shop_id' => '2',
                    'qty' => '11'
                ],
                [
                    'product_id' => '1385',
                    'shop_id' => '3',
                    'qty' => '3'
                ],
                [
                    'product_id' => '1385',
                    'shop_id' => '4',
                    'qty' => '2'
                ],
                [
                    'product_id' => '1369',
                    'shop_id' => '1',
                    'qty' => '1'
                ],
                [
                    'product_id' => '1369',
                    'shop_id' => '3',
                    'qty' => '1'
                ],
            ]);
        }
        $setup->endSetup();
    }
}