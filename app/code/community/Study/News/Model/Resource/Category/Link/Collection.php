<?php
/**
 * News item resource model
 */

class Study_News_Model_Resource_Category_Link_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('study_news/category_link');
    }

    /**
     * Filter Collection by News ID
     *
     * @param int $newsId
     *
     * @return Study_News_Model_Resource_Category_Link_Collection $this
     */
    public function addNewsIdFilter($newsId){
        $this->addFieldToFilter('news_id', $newsId);

        return $this;
    }

    /**
     * Filter Collection by Category ID
     *
     * @param int $categoryId
     *
     * @return Study_News_Model_Resource_Category_Link_Collection $this
     */
    public function addCategoryIdFilter($categoryId){
        $this->addFieldToFilter('category_id', $categoryId);

        return $this;
    }
}

