<?php
/**
 * News Data helper
 */
class Study_News_Helper_Data
    extends Mage_Core_Helper_Abstract
{
    /**
     * Path to store config if frontend output is enabled
     */
    const XML_PATH_ENABLED      = 'news/view/enabled';

    /**
     * Path to store config where count of news posts per page is stored
     */
    const XML_PATH_ITEMS_PER_PAGE   = 'news/view/items_per_page';

    /**
     * Path to store config where count of days while news is
     * still recently added is stored
     */
    const XML_PATH_DAYS_DIFFERENCE  = 'news/view/days_difference';

    /**
     * News Item instance for lazy loading
     *
     * @var Study_News_Model_News
     */
    protected $_newsItemInstance;

    /**
     * News Category instance for lazy loading
     *
     * @var Study_News_Model_Category
     */
    protected $_newsCategoryInstance;

    /**
     * Checks whether news can be displayed in the frontend
     *
     * @param integer|string|Mage_Core_Model_Store $store
     * @return boolean
     */
    public function isEnabled($store = null)
    {
        return Mage::getStoreConfigFlag(self::XML_PATH_ENABLED, $store);
    }

    /**
     * Return the number of items per page
     *
     * @param integer|string|Mage_Core_Model_Store $store
     * @return int
     */
    public function getNewsPerPage($store = null)
    {
        return abs((int)Mage::getStoreConfig(self::XML_PATH_ITEMS_PER_PAGE, $store));
    }

    /**
     * Return difference in days while news is recently added
     *
     * @param integer|string|Mage_Core_Model_Store $store
     * @return int
     */
    public function getDaysDifference($store = null)
    {
        return abs((int)Mage::getStoreConfig(self::XML_PATH_DAYS_DIFFERENCE, $store));
    }

    /**
     * Return current news item instance from the registry
     *
     * @return Study_News_Model_News
     */
    public function getNewsItemInstance()
    {
        if(!$this->_newsItemInstance){
            $this->_newsItemInstance = Mage::registry('news_item');

            if(!$this->_newsItemInstance){
                Mage::throwException($this->__('News item instance does not exist in Registry'));
            }
        }

        return $this->_newsItemInstance;
    }

    /**
     * Return current news category instance from the registry
     *
     * @return Study_News_Model_Category
     */
    public function getNewsCategoryInstance()
    {
        if(!$this->_newsCategoryInstance){
            $this->_newsCategoryInstance = Mage::registry('news_category');

            if(!$this->_newsCategoryInstance){
                Mage::throwException($this->__('News category instance does not exist in Registry'));
            }
        }

        return $this->_newsCategoryInstance;
    }



}

