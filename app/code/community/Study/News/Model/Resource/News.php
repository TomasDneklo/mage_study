<?php
/**
 * News item resurce model
 */

class Study_News_Model_Resource_News
    extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialze connection and define main table and primary key
     */
    protected function _construct()
    {
        $this->_init('study_news/news', 'news_id');
    }
}


