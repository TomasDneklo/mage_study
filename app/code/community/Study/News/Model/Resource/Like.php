<?php
/**
 * News item resurce model
 */

class Study_News_Model_Resource_Like
    extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Initialze connection and define main table and primary key
     */
    protected function _construct()
    {
        $this->_init('study_news/like', 'like_news_id');
    }



    /**
     * Get status of news exitence in DB
     *
     * @param int $customerId
     * @param int $newsId
     * @return bool
     */
    public function getCustomerLike($customerId, $newsId)
    {
        $select = $this->_loadLikedNewsByCustomer($customerId, $newsId);

        $rows = $this->_getReadAdapter()->fetchRow($select);

        if($rows["num"] > 0){
            return true;
        } else {
            return false;
        }

    }

    /**
     * Retrieve load select with filter by customer and news
     *
     * @param int $customerId
     * @param int $newsId
     * @return Varien_Db_Select
     */
    protected function _loadLikedNewsByCustomer($customerId, $newsId)
    {
        $select = $this->_getReadAdapter()->select()
            ->from(array('snl' => $this->getMainTable()))
            ->where('`customer_id` LIKE ?', $customerId)
            ->where('`news_id` LIKE ?', $newsId);

        return $select;
    }

}


