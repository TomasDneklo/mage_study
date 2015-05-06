<?php
/**
 * upgrade script for Study News extension
 *
 */

/**
 * @var $installer Mage_Core_Model_Resource_Setup
 */
$installer = $this;


$installer->startSetup();

$installer->getConnection()
    ->addColumn('meta_title', Varien_Db_Ddl_Table::TYPE_TEXT, 511, array(
        'nullable' => true,
        'default' => null
    ), 'News Meta Title')
    ->addColumn('meta_description', Varien_Db_Ddl_Table::TYPE_TEXT, 1023, array(
        'nullable' => true,
        'default' => null
    ), 'News Meta Description')
;


$installer->endSetup();
