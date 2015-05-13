<?php
/**
 * News List block
 */

class Study_News_Block_List extends Mage_Core_Block_Template
{
    /**
     * News collection
     *
     * @var Study_News_Model_Resource_News_Collection
     */
    protected $_newsCollection = null;

    /**
     * Layout edit
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        // add home breadcrumbs
        if ($breadcrumbs = $this->getLayout()->getBlock('breadcrumbs')) {
            $breadcrumbs->addCrumb(
                'home',
                array(
                    'label' => Mage::helper('study_news')->__('Home'),
                    'title' => Mage::helper('study_news')->__(
                        'Go to Home Page'
                    ),
                    'link'  => Mage::getBaseUrl(),
                )
            );

            // add news breadcrumb
            $breadcrumbs->addCrumb(
                'list',
                array('label' => Mage::helper('study_news')->__('News'))
            );
        }

    }

    /**
     * Retrieve news collection
     *
     * @return Study_News_Model_Resource_News_Collection
     */
    protected function _getCollection()
    {
        return Mage::getResourceModel('study_news/news_collection');
    }

    /**
     * Retrieve prepared news collection
     *
     * @return Study_News_Model_Resource_News_Collection
     */
    public function getCollection()
    {
        if(is_null($this->_newsCollection)){
            $this->_newsCollection = $this->_getCollection();
            $this->_newsCollection->prepareForList($this->getCurrentPage());
        }

        return $this->_newsCollection;
    }


    /**
     * Return URL to item's view page
     *
     * @param Study_News_Model_News $newsItem
     * @return string
     */
    public function getItemURL($newsItem)
    {
        if(!$newsItem->getSeoUrl()){
            return $this->getUrl('study_news/news/view', array('id' => $newsItem->getId()));
        } else {
            return $this->getUrl($newsItem->getSeoUrl());
        }

    }

    /**
     * Fetch the current page for the news list
     *
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->getData('current_page') ? $this->getData('current_page') : 1;
    }

    /**
     * Get a pager
     *
     * @return string|null
     */
    public function getPager()
    {
        $pager = $this->getChild('news_list_pager');

        if($pager){
            $newsPerPage = Mage::helper('study_news')->getNewsPerPage();

            $pager->setAvailableLimit(array($newsPerPage => $newsPerPage));
            $pager->setTotalNum($this->getCollection()->getSize());
            $pager->setCollection($this->getCollection());
            $pager->setShowPerPage(true);

            return $pager->toHtml();
        }

        return null;
    }

    /**
     * Return URL for resized News Item image
     *
     * @param Study_News_Model_News $item
     * @param integer $width
     * @return string|false
     */
    public function getImageUrl($item, $width)
    {
        return Mage::helper('study_news/image')->resize($item, $width);
    }

}