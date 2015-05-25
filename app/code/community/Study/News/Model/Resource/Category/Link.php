<?php
/**
 * News Category Link resurce model
 */

class Study_News_Model_Resource_Category_Link
    extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialze connection and define main table and primary key
     */
    protected function _construct()
    {
        $this->_init('study_news/category_link', 'link_id');
    }

}
