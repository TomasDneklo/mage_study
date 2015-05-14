<?php
/**
 * Liked News collection
 */

class Study_News_Model_Resource_Like_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('study_news/like');
    }
}

