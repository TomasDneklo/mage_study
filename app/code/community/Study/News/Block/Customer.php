<?php
/**
 * Customer Menu Section
 */
class Study_News_Block_Customer
    extends Mage_Customer_Block_Account_Dashboard
{
    /**
     * Liked News collection
     *
     * @var Study_News_Model_Resource_News_Collection
     */
    protected $_collection;

    /**
     * Initializes collection
     */
    protected function _construct()
    {
        $this->_collection = Mage::getModel('study_news/news')->getCollection();

    }


   /**
     * Return URL for delete action
     *
     * @param Study_News_Model_Like $liked_news
     * @return string
     */
    public function getDeleteUrl($liked_news)
    {
        return $this->getUrl(
            'news/customer/delete',
            array('id' => $liked_news->getId())
        );
    }

    /**
     * Get collection
     *
     * @return Study_News_Model_Resource_News_Collection
     */
    protected function _getCollection()
    {
        return $this->_collection;
    }

    /**
     * Get collection
     *
     * @return Study_News_Model_Resource_News_Collection
     */
    public function getCollection()
    {
        return $this->_getCollection();
    }

    public function getLiked(){
        //$customer_id = $this->getCustomer()->getId();
        //return $this->_collection->addCustomerFilter($customer_id);

        // TODO - filter out collection by customer_id

        return $this->_collection;

    }

}