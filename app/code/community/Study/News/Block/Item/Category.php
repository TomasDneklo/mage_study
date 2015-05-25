<?php
/**
 *
 */

class Study_News_Block_Item_Category extends Mage_Core_Block_Template
{

    /**
     * Return URL to add news to liked list
     *
     * @param $category Study_News_Model_Category
     * @return string
     */
    public function getSearchUrl($category)
    {
        return $this->getUrl('study_news/index/category',
            array('id' => $category->getId())
        );

    }

    /**
     * Get Linked Categories for News Item
     *
     */
    public function getLlinkedCategories(){
        $newsId = $this->getRequest()->getParam('id');

        /** @var $model Study_News_Model_Category */
        $model = Mage::getModel('study_news/category');

        return $model->getCollection()
            ->addNewsIdFilter($newsId);

    }

}
