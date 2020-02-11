<?php
/** 
 * @package   COP_DailyDeliveryReport
 * @author    Ricky Thakur (Kapil Dev Singh)
 * @copyright Copyright (c) 2018 Ricky Thakur
 * @license   MIT license (see LICENSE.txt for details)
 */

namespace COP\DailyDeliveryReport\Setup;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
    * {@inheritdoc}
    * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
    */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
          /**
          * Create table 'cop_daily_delivery_report'
          */
          $table = $setup->getConnection()
              ->newTable($setup->getTable('cop_daily_delivery_report'))
              ->addColumn(
                  'id',
                  \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                  null,
                  ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                  'Table ID'
              )
              ->addColumn(
                  'report_name',
                  \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                  null,
                  ['nullable' => false, 'default' => ''],
                    'Report Name'
              )
              ->addColumn(
                  'report_date',
                  \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                  null,
                  ['nullable' => false, 'default' => ''],
                  'Report Created Date'
              )
              ->addColumn(
                  'file_name',
                  \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                  null,
                  ['nullable' => false, 'default' => ''],
                  'Generated Report File Name'
              )
              ->addColumn(
                  'delivery_date',
                  \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                  null,
                  ['nullable' => false, 'default' => ''],
                  'Report Filtering Delivery Date'
              );
          $setup->getConnection()->createTable($table);
      }
}