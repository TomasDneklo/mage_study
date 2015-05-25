<?php
/**
 *
 */

class Study_News_Block_Category extends Study_News_Block_List
{
    public function _prepareLayout()
    {
        parent::_prepareLayout();

        $this->getLayout()->getBlock('news.list');

    }

    protected function _getCollection()
    {
        return parent::_getCollection()
            ->addCategoryIdFilter(Mage::registry('news_category')->getId()) ;
    }

}
