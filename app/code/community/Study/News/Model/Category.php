<?php
/**
 * News Category model
 */
class Study_News_Model_Category extends Mage_Core_Model_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('study_news/category');
    }

    protected function _afterSave()
    {
        $linkedCollection = Mage::getModel('study_news/category_link')
            ->getLinkedNewsCollection($this->getId());

        $linked = $this->getData('news');

        foreach ($linkedCollection as $item) {
            if (!in_array($item->getNewsId(), $linked)) {
                $item->isDeleted(true);
            }
            $linked = array_diff($linked, array($item->getNewsId()));
        }

        foreach ($linked as $newsId) {
            $item = Mage::getModel('study_news/category_link');
            $item->setData(
                array(
                    'news_id'       => $newsId,
                    'category_id'   => $this->getId(),
                )
            );
            $linkedCollection->addItem($item);
        }
        $linkedCollection->save();
    }



}

