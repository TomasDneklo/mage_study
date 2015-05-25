<?php
/**
 * News frontend controller
 */

class Study_News_IndexController
    extends Mage_Core_Controller_Front_Action
{
    /**
     * Pre dispatch action that allows to redirect to no route page in case of disabled extension through Admin panel
     */
    public function preDispatch(){
        parent::preDispatch();

        if(!Mage::helper('study_news')->isEnabled()){
            $this->setFlag('', 'no-dispatch', true);
            $this->_redirect('noRoute');
        }
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->loadLayout();

        $listBlock = $this->getLayout()->getBlock('news.list');

        if($listBlock){
            $currentPage = abs(intval($this->getRequest()->getParam('p')));

            if($currentPage < 1){
                $currentPage = 1;
            }
            $listBlock->setCurrentPage($currentPage);
        }

        $this->renderLayout();
    }

    /**
     * Index action
     */
    public function categoryAction()
    {
        $categoryId = $this->getRequest()->getParam('id');

        /** @var $model Study_News_Model_News */
        $model = Mage::getModel('study_news/category');
        $model->load($categoryId);

        if(!$model->getId()){
            return $this->_forward('noRoute');
        }

        Mage::register('news_category', $model);


        $this->loadLayout();
        /*
                $listBlock = $this->getLayout()->getBlock('news.list');


                        if($listBlock){
                            $currentPage = abs(intval($this->getRequest()->getParam('p')));

                            if($currentPage < 1){
                                $currentPage = 1;
                            }
                            $listBlock->setCurrentPage($currentPage);
                        }
                */
        $this->renderLayout();
    }



}


