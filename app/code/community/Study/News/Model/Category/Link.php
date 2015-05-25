<?php
/**
 * News Category Link model
 */
class Study_News_Model_Category_Link extends Mage_Core_Model_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('study_news/category_link');
    }

    /**
     * Get related news collection
     *
     * @param int $newsId
     *
     * @return Study_News_Model_Resource_Category_Link_Collection
     */
    public function getLinkedCategoryCollection($newsId)
    {
        // @var $collection Study_News_Model_Resource_Category_Link_Collection
        $collection = $this->getCollection()
            ->addNewsIdFilter($newsId);

        return $collection;
    }

    /**
     * Retrieve list of product IDs of related products
     *
     * @param int $newsId
     *
     * @return array array of Products IDs
     */
    public function getLinkedCategoriesIds($newsId)
    {
        $links = array();
        foreach ($this->getLinkedCategoryCollection($newsId) as $link) {
            $links[] = $link->getCategoryId();
        }
        return $links;
    }

    /**
     * Get related category collection
     *
     * @param int $categoryId
     *
     * @return Study_News_Model_Resource_Category_Link_Collection
     */
    public function getLinkedNewsCollection($categoryId)
    {
        // @var $collection Study_News_Model_Resource_Category_Link_Collection
        $collection = $this->getCollection()
            ->addCategoryIdFilter($categoryId);

        return $collection;
    }

    /**
     * Retrieve list of product IDs of related products
     *
     * @param int $categoryId
     *
     * @return array array of Products IDs
     */
    public function getLinkedNewsIds($categoryId)
    {
        $links = array();
        foreach ($this->getLinkedCategoryCollection($categoryId) as $link) {
            $links[] = $link->getNewsId();
        }
        return $links;
    }


}

