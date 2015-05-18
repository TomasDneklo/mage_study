<?php
/**
 * Related Product collection
 */

class Study_News_Model_Resource_Product_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define collection model
     */
    protected function _construct()
    {
        $this->_init('study_news/product');
    }

    /**
     * Filter Collection by Product ID
     *
     * @param int $productId
     *
     * @return Study_News_Model_Resource_Product_Collection $this
     */
    public function addProductIdFilter($productId){
        $this->addFieldToFilter('product_id', $productId);

        return $this;
    }

    /**
     * Filter Collection by News ID
     *
     * @param int $newsId
     *
     * @return Study_News_Model_Resource_Product_Collection $this
     */
    public function addNewsIdFilter($newsId){
        $this->addFieldToFilter('news_id', $newsId);

        return $this;
    }

    /**
     * Filter Collection by Relation Id
     *
     * @param int $productRelationId
     *
     * @return Study_News_Model_Resource_Product_Collection $this
     */
    public function addRelationIdFilter($productRelationId){
        $this->addFieldToFilter('product_relation_id', $productRelationId);

        return $this;
    }

}

