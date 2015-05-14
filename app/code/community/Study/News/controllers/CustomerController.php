<?php
/**
 * Customer section controller
 */
class Study_News_CustomerController extends Mage_Core_Controller_Front_Action
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->loadLayout();

        if ($navigationBlock = $this->getLayout()->getBlock('customer_account_navigation')) {
            $navigationBlock->setActive('study_news/customer/index');
        }

        $this->renderLayout();
    }

    /**
     * Delete action
     */
    public function removeAction()
    {
        // check if we know what shoud be deleted
        // TODO - check if liked id belongs to customer
        $likedNewsId = $this->getRequest()->getParam('id');
        if ($likedNewsId) {
            if($this->_checkLikedNewsOwner($likedNewsId)){
                $this->_removeNewsFromList($likedNewsId);
            }
        }

        // go to 'back'
        $this->_redirectReferer();
    }

    protected function _removeNewsFromList($likedNewsId)
    {
        // init model and delete
        /** @var $model Study_News_Model_Like */
        $model = Mage::getModel('study_news/like');
        $model->load($likedNewsId);

        if (!$model->getId()) {
            Mage::log(Mage::helper('study_news')->__('Unabel to find a liked news.'));
        }

        $model->delete();
    }


    protected function _checkLikedNewsOwner($likedNewsId)
    {
        $likedNewsId;

        // TODO - real check
        return true;
    }
}