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
    public function deleteAction()
    {
        // check if we know what shoud be deleted
        // TODO - check if liked id belongs to customer
        $likeItemId = $this->getRequest()->getParam('id');
        if ($likeItemId) {

            // init model and delete
            /** @var $model Study_News_Model_Like */
            $model = Mage::getModel('study_news/like');
            $model->load($likeItemId);

            if (!$model->getId()) {
                Mage::log(Mage::helper('study_news')->__('Unabel to find a liked news.'));
            }

            $model->delete();

        }

        // go to 'back'
        $this->_redirectReferer();
    }
}