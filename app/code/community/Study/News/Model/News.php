<?php
/**
 * News item model
 *
 */

class Study_News_Model_News extends Mage_Core_Model_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('study_news/news');
    }

    /**
     * If object is new adds creation date
     *
     * @return Study_News_Model_News
     */
    protected function _beforeSave()
    {
        parent::_beforeSave();
        if($this->getId()){
            $this->setData('created_at', Varien_Date::now());
        }
        return $this;
    }

    protected function _afterSave(){
        $productCollection = Mage::getModel('study_news/product')
            ->getRelatedCollection($this->getId());

        $related = $this->getData('related');
        foreach ($productCollection as $item) {
            if (!in_array($item->getProductId(), $related)) {
                $item->isDeleted(true);
            }
            $related = array_diff($related, array($item->getProductId()));
        }

        foreach ($related as $productId) {
            $item = Mage::getModel('study_news/product');
            $item->setData(
                array(
                    'news_id'    => $this->getId(),
                    'product_id' => $productId,
                )
            );
            $productCollection->addItem($item);
        }
        $productCollection->save();
    }


    /**
     * Check if news SEO URL exist for specific store
     * return page id if page exists
     *
     * @param string $seo_url
     * @return int
     */
    public function checkSeoUrl($seo_url)
    {
        return $this->_getResource()->getSeoUrl($seo_url);
    }

}



