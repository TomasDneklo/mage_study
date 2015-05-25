<?php
/**
 * News category resurce model
 */

class Study_News_Model_Resource_Category
    extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialze connection and define main table and primary key
     */
    protected function _construct()
    {
        $this->_init('study_news/category', 'category_id');
    }

}


