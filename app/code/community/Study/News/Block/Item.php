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
     * Layout edit Meta tags setting
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if ($headBlock = $this->getLayout()->getBlock('head')) {
            $newsItem = Mage::helper('study_news')->getNewsItemInstance();

            // add home breadcrumbs
            if ($breadcrumbs = $this->getLayout()->getBlock('breadcrumbs')) {
                $breadcrumbs->addCrumb(
                    'home',
                    array(
                        'label'=>Mage::helper('study_news')->__('Home'),
                        'title'=>Mage::helper('study_news')->__('Go to Home Page'),
                        'link'=>Mage::getBaseUrl(),
                    )
                );

                // add news breadcrumb
                $breadcrumbs->addCrumb(
                    'list',
                    array(
                        'label'=>Mage::helper('study_news')->__('News'),
                        'title'=>Mage::helper('study_news')->__('News Listing Page'),
                        'link'=>Mage::getUrl('study_news'),
                    )
                );


                // add news breadcrumb
                $breadcrumbs->addCrumb(
                    'news',
                    array('label'=>$newsItem->getTitle())
                );

            }

            if ($title = $newsItem->getMetaTitle()) {
                $headBlock->setTitle($title);
            } else {
                $headBlock->setTitle(
                    $newsItem->getTitle()
                    . ' :: ' . $headBlock->getTitle()
                );
            }

            if ($description = $newsItem->getMetaDescription()) {
                $headBlock->setDescription($description);
            } else {
                $headBlock->setDescription(
                    $headBlock->getTitle()
                );
            }
        }

        return $this;
    }

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
     * @param Study_News_Model_News $item
     * @param integer $width
     * @return string|false
     */
    public function getImageUrl($item, $width){
        return Mage::helper('study_news/image')->resize($item, $width);
    }

}
