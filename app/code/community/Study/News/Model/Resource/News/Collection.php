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

    /**
     * Add customer id filter
     *
     * @param int $customerId
     * @return Study_News_Model_Resource_News_Collection
     */
    public function addCustomerIdFilter($customerId)
    {
        $this->getSelect()
            ->join(
                array('snl' => $this->getTable('study_news/like')),
                'main_table.news_id = snl.news_id',
                array('snl.like_news_id AS like_id')
            )
            ->where('snl.customer_id = ?', $customerId);

        return $this;
    }



    public function addPublishToFilter($to = false)
    {
        $to = $to ? $to : date("Y-m-d");

        $this->addFieldToFilter('published_at',
                array('to' => $to )
            );

        return $this;
    }


    /**
     * Add Category ID filter
     *
     * @param int $categoryId
     * @return Study_News_Model_Resource_News_Collection
     */
    public function addCategoryIdFilter($categoryId)
    {
        $this->getSelect()
            ->join(
                array('sncl' => $this->getTable('study_news/category_link')),
                'main_table.news_id = sncl.news_id',
                array('')
            )
            ->where('sncl.category_id = ?', $categoryId);

        return $this;
    }

}

