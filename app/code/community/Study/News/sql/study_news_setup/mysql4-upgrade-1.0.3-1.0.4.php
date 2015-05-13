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

$table = $installer->getConnection()
    ->newTable($installer->getTable('study_news/like'))
    ->addColumn('like_news_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary'  => true,
    ), 'News Like id')
    ->addColumn('news_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'identity'  => false,
        'unsigned'  => true,
        'nullable'  => false,
    ), 'News Id')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'identity'  => false,
        'unsigned'  => true,
        'nullable'  => false,
    ), 'Customer Entity Id')
    ->addForeignKey(
        $installer->getFkName(
            'study_news/like', 'news_id',
            'study_news/news','news_id'
        ),
        'news_id',
        $installer->getTable('study_news/news'),
        'news_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->addForeignKey(
        $installer->getFkName(
            'study_news/like', 'customer_id',
            'customer/entity','entity_id'
        ),
        'customer_id',
        $installer->getTable('customer/entity'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->addIndex(
        $installer->getIdxName(
            'study_news/like',
            array('news_id', 'customer_id'),
            Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
        ),
        array('news_id', 'customer_id'),
        array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE)
    )
    ->setComment('Customer Liked News');

$installer->getConnection()->createTable($table);

$installer->endSetup();

