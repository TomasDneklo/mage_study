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
        /** @var $collection Study_News_Model_Resource_Like_Collection */
        $collection = $this->getCollection()
            ->addCustomerIdFilter($customerId)
            ->addNewsIdFilter($newsId)
        ;

        return (bool)$collection->getSize();
    }

    /**
     * Get status of news ownership check
     *
     * @param int $customerId
     * @param int $likedNewsId
     * @return bool
     */
    public function checkLikedNewsOwner($customerId, $likedNewsId)
    {
        /** @var $collection Study_News_Model_Resource_Like_Collection */
        $collection = $this->getCollection()
            ->addLikeNewsIdFilter($likedNewsId);

        return (bool)($customerId == $collection->getFirstItem()->getCustomerId());
    }

}

