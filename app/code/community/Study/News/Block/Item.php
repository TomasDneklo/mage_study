<?php
/**
 * News Item Block
 */
class Study_News_Block_Item
    extends Mage_Core_Block_Template
{
    /**
     * Current News item instance
     *
     * @var Study_News_Model_News
     */
    protected $_item;

    /**
     * Return parameters for bace url
     *
     * @param array $additionalParams
     * @return array
     */
    protected function _getBackUrlQueryParams($additionalParams = array())
    {
        return array_merge(array('p' => $this->getPage()),
            $additionalParams);
    }

    /**
     * Return URL to the news list page
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/',
            array('_query' => $this->_getBackUrlQueryParams()));
    }

    /**
     * Return URL for resized News Item image
     *
     * @param Study_News_Model_news $item
     * @param integer $width
     * @return string|false
     */
    public function getImageUrl($item, $width){
        return Mage::helper('study_news/image')->resize($item, $width);
    }

}
