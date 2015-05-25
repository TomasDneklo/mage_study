<?php
class Study_News_Helper_News
    extends Mage_Core_Helper_Abstract
{
    /**
     * Retrieve news direct URL
     *
     * @param string $newsId
     * @return string
     */
    public function getNewsUrl($newsId = null)
    {
        $news = Mage::getModel('study_news/news');
        if (!is_null($newsId) && $newsId !== $news->getId()) {
            $news->setStoreId(Mage::app()->getStore()->getId());
            if (!$news->load($newsId)) {
                return null;
            }
        }

        if (!$news->getId()) {
            return null;
        }

        return Mage::getUrl(null, array('_direct' => $news->getSeoUrl()));
    }

}




