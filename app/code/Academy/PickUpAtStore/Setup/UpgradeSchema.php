<?php

namespace Academy\PickUpAtStore\Setup;;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;


class UpgradeSchema implements UpgradeSchemaInterface
{

    private static $connectionName = 'sales';

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (version_compare($context->getVersion(), '0.1.2', '<')) {

            $product_pickup = $installer->getConnection()
                ->newTable($installer->getTable('product_pickup'))
                ->addColumn(
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    11,
                    ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                    'Entity Id'
                )
                ->addColumn(
                    'product_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    255,
                    ['identity' => false, 'nullable' => false, 'primary' => false],
                    'Product Id'
                )->addColumn(
                    'shop_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    255,
                    ['unsigned' => true, 'nullable' => false],
                    'Shop Id'
                )->addColumn(
                    'qty',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    255,
                    [ 'identity' => false, 'nullable' => true, 'primary' => false],
                    'Qty'
                )->addColumn(
                    'created_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
                    'Created At'
                )->addColumn(
                    'updated_at',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
                    null,
                    ['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
                    'Updated At'
                )->addForeignKey(
                    $installer->getFkName('product_pickup','shop_id','store_list','id'),
                    'shop_id',
                    $installer->getTable('store_list'),
                    'id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->setComment('Products Pickup');

            $installer->getConnection()->createTable($product_pickup);
            $installer->endSetup();
        }
    }

}
