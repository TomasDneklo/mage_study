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
$conn->addColumn($tableName, 'seo_url', 'VARCHAR(127) NOT NULL COMMENT \'SEO URL string\'');

$installer->endSetup();

