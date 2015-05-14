<?php
/**
 *
 */

class Study_News_Block_Like extends Mage_Core_Block_Template
{

    /**
     * Return URL to add news to liked list
     *
     * @return string
     */
    public function getLikeItUrl()
    {
        $newsItem = Mage::helper('study_news')->getNewsItemInstance();

        return $this->getUrl('study_news/news/like',
            array('id' => $newsItem->getId())
        );

    }

    /**
     * check alrady liked news
     */
    public function isLiked(){
        if($customerId = Mage::getSingleton('customer/session')->getCustomerId()){

            $newsId = $this->getRequest()->getParam('id');

            /** @var @var $model Study_News_Model_Like */
            $model = Mage::getModel('study_news/like');

            $model->checkCustomerLike($customerId, $newsId);
        } else {
            return false;
        }
    }
}