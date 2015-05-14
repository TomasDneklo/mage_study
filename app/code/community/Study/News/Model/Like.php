<?php
/**
 * Like News model
 */
class Study_News_Model_Like extends Mage_Core_Model_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('study_news/like');
    }


    /**
     * Get status of news exitence in DB
     *
     * @param int $customerId
     * @param int $newsId
     * @return bool
     */
    public function checkCustomerLike($customerId, $newsId)
    {
        return $this->_getResource()->getCustomerLike($customerId, $newsId);
    }

}

