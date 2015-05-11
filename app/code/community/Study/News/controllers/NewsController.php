<?php
/**
 * News frontend controller
 */

class Study_News_NewsController
    extends Mage_Core_Controller_Front_Action
{

    /**
     * News view action
     */
    public function viewAction()
    {

        $newsId = $this->getRequest()->getParam('id');

        if(!$newsId){
            return $this->_forward('noRoute');
        }

        /** @var $model Study_News_Model_News */
        $model = Mage::getModel('study_news/news');
        $model->load($newsId);

        if(!$model->getId()){
            return $this->_forward('noRoute');
        }

        Mage::register('news_item', $model);

        Mage::dispatchEvent('before_news_item_display', array('news_item' => $model));

        $this->loadLayout();

        $itemBlock = $this->getLayout()->getBlock('news.item');

        if($itemBlock){
            $listBlock = $this->getLayout()->getBlock('news.list');
            if($listBlock){
                $page = (int)$listBlock->getCurrentPage() ? (int)$listBlock->getCurrentPage() : 1;
            } else {
                $page = 1;
            }
            $itemBlock->setPage($page);
        }
        $this->renderLayout();
    }
}
