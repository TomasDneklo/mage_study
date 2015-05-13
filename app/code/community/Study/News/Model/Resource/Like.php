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
     * Retrieve list of news collection liked by customer
     *
     * @param int $customer_id
     *
     * @return Varien_Db_Select
     */
    public function getLikedNewsByCustomer($customer_id)
    {
        $select = $this->_getReadAdapter()->select()
            ->from(array('snn' => $this->getTable('study_news/news')))
            ->joinInner(array(
                'snl' => $this->getMainTable()),
                'snn.news_id = snl.news_id'
            )
            ->where('snl.customer_id = ?', $customer_id);

        return $select;
    }


}


