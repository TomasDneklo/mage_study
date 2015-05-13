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



    /**
     * Check if news SEO URL is deffined for specific store
     * return news id if page exists
     *
     * @param string $seo_url
     * @return int
     */
    public function getSeoUrl($seo_url)
    {
        $select = $this->_getLoadBySeoUrlSelect($seo_url);
        $select->reset(Zend_Db_Select::COLUMNS)
            ->columns('news_id')
            ->limit(1);

        return $this->_getReadAdapter()->fetchOne($select);
    }

    /**
     * Retrieve load select with filter by identifier, store and activity
     *
     * @param string $seo_url
     * @return Varien_Db_Select
     */
    protected function _getLoadBySeoUrlSelect($seo_url)
    {
        $select = $this->_getReadAdapter()->select()
            ->from(array('sn' => $this->getMainTable()))
            ->where('`seo_url` LIKE ?', $seo_url);
        return $select;
    }

}


