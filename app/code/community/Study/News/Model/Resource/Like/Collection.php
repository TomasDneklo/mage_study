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

    /**
     * Filter Collection by Customer ID
     *
     * @param int $customerId
     *
     * @return Study_News_Model_Resource_Like_Collection $this
     */
    public function addCustomerIdFilter($customerId){
        $this->addFieldToFilter('customer_id', $customerId);

        return $this;
    }

    /**
     * Filter Collection by News ID
     *
     * @param int $newsId
     *
     * @return Study_News_Model_Resource_Like_Collection $this
     */
    public function addNewsIdFilter($newsId){
        $this->addFieldToFilter('news_id', $newsId);

        return $this;
    }

    /**
     * Filter Collection by Like News ID
     *
     * @param int $likeNewsId
     *
     * @return Study_News_Model_Resource_Like_Collection $this
     */
    public function addLikeNewsIdFilter($likeNewsId){
        $this->addFieldToFilter('news_id', $likeNewsId);

        return $this;
    }

}

