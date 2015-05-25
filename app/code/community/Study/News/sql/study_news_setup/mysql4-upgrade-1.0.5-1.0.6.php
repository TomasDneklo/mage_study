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

$tableCat = $installer->getConnection()
    ->newTable($installer->getTable('study_news/category'))
    ->addColumn('category_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary'  => true,
    ), 'Category Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 63, array(
        'nullable' => true,
        'default'  => null,
    ), 'Category Name')
    ->setComment('News Categories');

$installer->getConnection()->createTable($tableCat);


$tableRel = $installer->getConnection()
    ->newTable($installer->getTable('study_news/category_link'))
    ->addColumn('link_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary'  => true,
    ), 'Link Id')
    ->addColumn('news_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'identity'  => false,
        'unsigned'  => true,
        'nullable'  => false,
    ), 'News Id')
    ->addColumn('category_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'identity'  => false,
        'unsigned'  => true,
        'nullable'  => false,
    ), 'News Category Id')
    ->addForeignKey(
        $installer->getFkName(
            'study_news/category_link', 'news_id',
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
            'study_news/category_link', 'category_id',
            'study_news/category','category_id'
        ),
        'category_id',
        $installer->getTable('study_news/category'),
        'category_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->addIndex(
        $installer->getIdxName(
            'study_news/category_link',
            array('news_id', 'category_id'),
            Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE
        ),
        array('news_id', 'category_id'),
        array('type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE)
    )
    ->setComment('News Categories');

$installer->getConnection()->createTable($tableRel);

$installer->endSetup();

