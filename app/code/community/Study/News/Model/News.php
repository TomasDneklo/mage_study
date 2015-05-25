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

    protected function _afterSave()
    {
        $relations = array();

        // set related product parameters
        $relations[] = array(
            'entity'    => 'product',
            'collection'=> Mage::getModel('study_news/product')
                ->getRelatedCollection($this->getId()), // entity name
            'field'     => 'product_id',  // field name
            'param'     => 'getProductId', // model get entity name
            'selected'       => $this->getData('related') // model registry key name
        );

        // set linked categories parameters
        $relations[] = array(
            'entity'    => 'category_link',
            'collection'=> Mage::getModel('study_news/category_link')
                ->getLinkedCategoryCollection($this->getId()),
            'field'     => 'category_id',
            'param'     => 'getLinkId',
            'selected'       => $this->getData('category')
        );


        $this->_saveRelations($relations);

    }

    protected function _saveRelations($relations)
    {
        foreach($relations AS $relation){
            $collection = $relation['collection'];

            $selected = $relation['selected'];
            foreach ($collection as $item) {
                if (!in_array($item->$relation['param'](), $selected)) {
                    $item->isDeleted(true);
                }
                $selected = array_diff($selected, array($item->$relation['param']()));
            }

            foreach ($selected as $selectedId) {
                $item = Mage::getModel('study_news/'.$relation['entity']);
                $item->setData(
                    array(
                        'news_id'           => $this->getId(),
                        $relation['field']  => $selectedId,
                    )
                );
                $collection->addItem($item);
            }
            $collection->save();
        }

    }

/*
    protected function _saveRelated()
    {
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
*/

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

