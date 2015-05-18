<?php
/**
 * Like News model
 */
class Study_News_Model_Product extends Mage_Core_Model_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('study_news/product');
    }


    /**
     * Get status of news exitence in DB
     *
     * @param int $customerId
     * @param int $newsId
     * @return bool
     */
/*
    public function checkCustomerLike($customerId, $newsId)
    {
        // @var $collection Study_News_Model_Resource_Product_Collection
        $collection = $this->getCollection()
            ->addCustomerIdFilter($customerId)
            ->addNewsIdFilter($newsId)
        ;

        return (bool)$collection->getSize();
    }
*/

    /**
     * Get related news collection
     *
     * @param int $newsId
     *
     * @return Study_News_Model_Resource_Product_Collection
     */
    public function getRelatedCollection($newsId)
    {
        // @var $collection Study_News_Model_Resource_Product_Collection
        $collection = $this->getCollection()
            ->addNewsIdFilter($newsId);

        return $collection;
    }

    /**
     * Retrieve related products
     *
     * @param int $newsId
     *
     * @return array
     */
    public function getRelationsIds($newsId)
    {
        $products = array();
        foreach ($this->getRelatedCollection($newsId) as $relation) {
            $products[] = $relation->getProductId();
        }
        return $products;
    }


}

