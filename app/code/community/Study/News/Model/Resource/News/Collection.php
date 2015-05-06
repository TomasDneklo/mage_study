<?php
/**
 * News item resource model
 */

class Study_News_Model_Resource_News_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('study_news/news');
    }

    /**
     * Prepare for displaying in list
     *
     * @param integer $page
     * @return Study_News_Model_Resource_News_Collection
     */
    public function prepareForList($page)
    {
        $this->setPageSize(Mage::helper('study_news')->getNewsPerPage());
        $this->setCurPage($page)->setOrder('published_at', Varien_Data_Collection::SORT_ORDER_DESC);
        return $this;
    }
}

