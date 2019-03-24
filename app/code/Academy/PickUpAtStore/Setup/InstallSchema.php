<?php

namespace Academy\PickUpAtStore\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        unset($context);
        $installer = $setup;
        $installer->startSetup();

        $stores = $installer->getConnection()
            ->newTable($installer->getTable('store_list'))
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                11,
                [ 'identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Store Id'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [ 'identity' => false, 'nullable' => false, 'primary' => false],
                'Store name'
            )->addColumn(
                'address',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [ 'identity' => false, 'nullable' => true, 'primary' => false],
                'Store address'
            )->addColumn(
                'contacts',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                [ 'identity' => false, 'nullable' => true, 'primary' => false],
                'Store contacts'
            )->addColumn(
                'description',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                1500,
                [ 'identity' => false, 'nullable' => true, 'primary' => false],
                'Store description'
            )->addColumn(
                'isActive',
                \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
                1,
                [ 'identity' => false, 'unsigned' => true, 'nullable' => false, 'default' => 1, 'primary' => false],
                'Store status'
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
            )->addColumn(
                'store_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                null,
                ['unsigned' => true, 'nullable' => false, 'default' => '0'],
                'Store Id'
            )
            ->setComment('Store list');

        $installer->getConnection()->createTable($stores);

        $installer->endSetup();
    }
}
