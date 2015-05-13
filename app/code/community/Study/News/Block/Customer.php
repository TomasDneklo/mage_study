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

        $customer_id = $this->getCustomer()->getId();

        return $this->_collection->addCustomerIdFilter($customer_id);
    }


    /**
     * Return URL for delete action
     *
     * @param Study_News_Model_News $liked_news
     * @return string
     */
    public function getRemoveUrl($liked_news)
    {
        return $this->getUrl(
            'study_news/customer/remove',
            array('id' => $liked_news->getLikeId())
        );
    }


    /**
     * Return URL for delete action
     *
     * @param Study_News_Model_News $liked_news
     * @return string
     */
    public function getViewUrl($liked_news)
    {
        return $this->getUrl(
            'study_news/news/view',
            array('id' => $liked_news->getLikeId())
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

}