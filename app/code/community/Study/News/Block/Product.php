<?php
/**
 *
 */

class Study_News_Block_Product extends Mage_Catalog_Block_Product_Abstract
{
    /**
     * Related Products collection
     *
     * @var Varien_Data_Collection
     */
    protected $_productCollection = null;

    /**
     * @var int News ID
     */
    protected $_newsId;


    /**
     * Load Product collection
     */
    protected function _getCollection()
    {
        $collection = Mage::getModel('catalog/product_link')
            ->useRelatedLinks()
            ->getProductCollection()
            ->addAttributeToSelect('*');


        $collection->getSelect()->join(
            // $this->getTable('study_news/product') - not working ?
            array('snp' => 'study_news_product'),
            'e.entity_id = snp.product_id',
            array('')
        )->where('snp.news_id = ?', $this->_newsId);

        $this->_productCollection = $collection;

    }

    /**
     * Retrieve news collection
     *
     * @param int $newsId News ID
     *
     * @return array
     */
    public function getCollection($newsId)
    {
        $this->_newsId = $newsId;

        if(is_null($this->_productCollection)){
            $this->_getCollection();
        }

        return $this->_productCollection;
    }


}