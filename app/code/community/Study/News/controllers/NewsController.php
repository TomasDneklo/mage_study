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

        $this->renderLayout();
    }


    public function likeAction()
    {
        if(Mage::getSingleton('customer/session')->isLoggedIn()) {

            // if news item exists, try to load it
            $newsId = $this->getRequest()->getParam('id');
            $customerId = Mage::getSingleton('customer/session')->getCustomerId();

            if(!$this->_checkAlreadyLiked($customerId, $newsId)){
                $this->_saveLike($customerId, $newsId);
            }

            // TODO - redirect after login to news not to referer
            $this->_redirectReferer();
        } else {
            $this->_setRedirectAfterLogin();

            $this->_redirect('customer/account');
        }

    }

    /**
     * Save Like to DB
     *
     * @param int $customerId
     * @param int $newsId
     *
     * @throws Exception
     */
    protected function _saveLike($customerId, $newsId)
    {
        // init model and set data
        /* @var $model Study_News_Model_News */
        $model = Mage::getModel('study_news/like');
        $data = array(
            'news_id'       => $newsId,
            'customer_id'   => $customerId,
        );

        $model->addData($data);

        // save the data
        $model->save();
    }


    /**
     * Check customer already liked news
     *
     * @param $customerId
     * @param $newsId
     *
     * @return bool
     */
    protected function _checkAlreadyLiked($customerId, $newsId){
        $model = Mage::getModel(('study_news/like'));

        $status =  $model->checkCustomerLike($customerId, $newsId);

        return $status;
        // TODO - add real check
        // return false;
    }


    protected function _setRedirectAfterLogin(){
        $session = Mage::getSingleton('customer/session');
/*
        if ($this->getRequest()->getRequestUri()){
            $session->setAfterAuthUrl(Mage::getUrl($this->getRequest()
                ->getRequestUri())
            );
        } else {*/
            $session->setAfterAuthUrl(Mage::helper('core/http')->getHttpReferer());
 //       }
    }
}
