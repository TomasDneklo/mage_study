<?php
/**
 * Related category collection
 */

class Study_News_Model_Resource_Category_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('study_news/category');
    }

    /**
     * Filter Collection by Category ID
     *
     * @param int $categoryId
     *
     * @return Study_News_Model_Resource_Category_Collection
     */
    public function addCategoryIdFilter($categoryId){
        $this->addFieldToFilter('category_id', $categoryId);

        return $this;
    }

    /**
     * Add News ID filter
     *
     * @param int $newsId
     * @return Study_News_Model_Resource_Category_Collection
     */
    public function addNewsIdFilter($newsId)
    {
        $this->getSelect()
            ->join(
                array('sncl' => $this->getTable('study_news/category_link')),
                'main_table.category_id = sncl.category_id',
                array('sncl.link_id AS link_id')
            )
            ->where('sncl.news_id = ?', $newsId);

        return $this;
    }

}

