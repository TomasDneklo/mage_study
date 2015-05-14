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
        $newsId = $this->getRequest()->getParam('id');

        if(Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customerId = Mage::getSingleton('customer/session')->getCustomerId();

            if(!$this->_checkAlreadyLiked($customerId, $newsId)){
                $this->_saveLike($customerId, $newsId);
            }

            $redirectPath = 'study_news/news/view/';
            $redirectParam = array('id' => $newsId);
            $this->_redirect(
                $redirectPath,
                $redirectParam
            );

        } else {
            $this->_setRedirectAfterLogin($newsId);

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
        /** @var @var $model Study_News_Model_Like */
        $model = Mage::getModel('study_news/like');

        return $model->checkCustomerLike($customerId, $newsId);
    }


    protected function _setRedirectAfterLogin($newsId){
        $session = Mage::getSingleton('customer/session');

        $redirectPath = 'study_news/news/like/';
        $redirectParam = array('id' => $newsId);
        $redirectUrl = Mage::getUrl($redirectPath, $redirectParam);

        $session->setAfterAuthUrl($redirectUrl);

    }
}
