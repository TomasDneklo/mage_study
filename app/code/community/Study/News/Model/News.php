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


}



