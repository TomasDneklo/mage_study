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

$tableName = $installer->getTable('study_news/news');

$conn = $installer->getConnection();
$conn->addColumn($tableName, 'meta_title', 'VARCHAR(511) NOT NULL COMMENT \'Meta Title Tag\'');
$conn->addColumn($tableName, 'meta_description', 'VARCHAR(1023) NOT NULL COMMENT \'Meta Description Tag\'');
//$conn->addColumn($tableName, 'meta_keywords', 'VARCHAR(1023) NOT NULL COMMENT \'Meta Keywords Tag\'');


$installer->endSetup();

