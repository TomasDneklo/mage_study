<?php
/**
 * News Module observer
 *
 */
class Study_News_Model_Observer
{
    /**
     * Event before show news item on frontend
     * If specified news post was added recentrly (term is defined in config) we'll see messages about this on frontend.
     *
     * @param Varien_Event_Observer $observer
     */
    public function beforeNewsDisplayed(Varien_Event_Observer $observer)
    {
        $newsItem = $observer->getEvent()->getNewsItem();
        $currentDate = Mage::app()->getLocale()->date();
        $newsCreatedAt = Mage::app()->getLocale()->date(strtotime($newsItem->getCreatedAt()));
        $daysDifference = $currentDate->sub($newsCreatedAt)->getTimestamp() / (60 * 60 * 24);
        if($daysDifference < Mage::helper('study_news')->getDaysDifference()){
            Mage::getSingleton('core/session')
                ->addSuccess(Mage::helper('study_news')
                ->__('Recently added'));
        }
    }
}