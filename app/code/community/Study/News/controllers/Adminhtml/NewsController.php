<?php
/**
 * News controller
 *
 * @author HausO
 */
class Study_News_Adminhtml_NewsController
    extends Mage_Adminhtml_Controller_Action
{

    /**
     * @param string $idFieldName
     *
     * @return $this
     */
    protected function _initNews($idFieldName = 'id')
    {
        $this->_title($this->__('News'))->_title($this->__('News'));

        $newsId = (int) $this->getRequest()->getParam($idFieldName);

        $news = Mage::getModel('study_news/news');

        if ($newsId) {
            $news->load($newsId);
        }

        Mage::register('current_study_news', $news);

        return $this;
    }


    /**
     * Init actions
     *
     * @return Study_News_Adminhtml_NewsController
     */
    protected function _initAction()
    {
        //load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('news/news')
            ->_addBreadcrumb(
                    Mage::helper('study_news')->__('News'),
                    Mage::helper('study_news')->__('News')
                )
            ->_addBreadcrumb(
                Mage::helper('study_news')->__('Manage News'),
                Mage::helper('study_news')->__('Manage News')
            );

        $this->_initNews();

        return $this;
    }

    /**
     * Index action
     */
    public function indexAction(){
        $this->_title($this->__('News'))
            ->_title($this->__('Manage News'));

        $this->_initAction();

        $this->renderLayout();
    }

    /**
     * Create News item
     */
    public function newAction()
    {
        // the same form is used to create and edit
        $this->_forward('edit');
    }

    /**
     * Edit News item
     */
    public function editAction()
    {
        $this->_title($this->__('News'))
            ->_title('Manage News');

        // 1. instance nes model
        /* @var $model Study_News_Model_News */
        $model = Mage::getModel('study_news/news');

        // 2. if ID exists, check it and load data
        $newsId = $this->getRequest()->getParam('id');
        if($newsId){
            $model->load($newsId);

            if(!$model->getId()){
                $this->_getSession()->addError(
                    Mage::helper('study_news')->__('News item does not exist.')
                );
                return $this->_redirect('*/*/');
            }
            // prepare title
            $this->_title($model->getTitle());
            $breadCrumb = Mage::helper('study_news')->__('Edit Item');
        } else {
            $this->_title(Mage::helper('study_news')->__('New Item'));
            $breadCrumb = Mage::helper('study_news')->__('New Item');
        }

        // Init breadcrumbs
        $this->_initAction()->_addBreadCrumb($breadCrumb, $breadCrumb);

        // 3. Set entered data if there was an error during save
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if(!empty($data)){
            $model->addData($data);
        }

        // 4. Register model to use later in blocks
        Mage::register('news_item', $model);

        // 5. render layout
        $this->renderLayout();
    }

    /**
     * Save action
     */
    public function saveAction(){
        $redirectPath = '*/*';
        $redirectParams = array();

        // check if data sent
        $data = $this->getRequest()->getPost();
        if($data){
            $data = $this->_filterPostData($data);
            // init model and set data
            /* @var $model Study_News_Model_News */
            $model = Mage::getModel('study_news/news');

            // if news item exists, try to load it
            $newsId = $this->getRequest()->getParam('news_id');
            if($newsId){
                $model->load($newsId);
            }

            // save image data and remove from data array
            if(isset($data['image'])){
                $imageData = $data['image'];
                unset($data['image']);
            } else {
                $imageData = array();
            }
            $model->addData($data);

            try {
                $hasError = false;

                /* @var $imageHelper Study_News_Helper_Image */
                $imageHelper = Mage::helper('study_news/image');
                // remove image

                if (isset($imageData['delete']) && $model->getImage()) {
                    $imageHelper->removeImage($model->getImage());
                    $model->setImage(null);
                }

                // upload new image
                $imageFile = $imageHelper->uploadImage('image');
                if ($imageFile) {
                    if ($model->getImage()) {
                        $imageHelper->removeImage($model->getImage());
                    }
                    $model->setImage($imageFile);
                }

                $model->setData('related', $this->getRequest()->getParam('related'));
                $model->setData('category', $this->getRequest()->getParam('category'));

                // save the data
                $model->save();

                // dispay success message
                $this->_getSession()->addSuccess(
                    Mage::helper('study_news')->__('The news item has been saved.')
                );

                // check if 'Save and Continue'
                if($this->getRequest()->getParam('back')){
                    $redirectPath = '*/*/edit';
                    $redirectParams = array('id' => $model->getId());
                }
            } catch (Mage_Core_Exception $e) {
                $hasError = true;
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e){
                $hasError = true;
                $this->_getSession()->addException($e,
                    Mage::helper('study_news')->__('An Error occured while saveing news item.')
                    );
            }

            // check if 'Save and Continue'
            if($hasError){
                $this->_getSession()->setFormData($data);
                $redirectPath = '*/*/edit';
                $redirectParams = array('id' => $this->getRequest()->getParam('id'));
            }
        }

        $this->_redirect($redirectPath, $redirectParams);
    }


    /**
     * Delete action
     */
    public function deleteAction()
    {
        // check if we know what shoud be deleted
        $itemId = $this->getRequest()->getParam('id');
        if ($itemId) {
            try {
                // init model and delete
                /** @var $model Study_News_Model_News */
                $model = Mage::getModel('study_news/news');
                $model->load($itemId);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('study_news')->__('Unabel to find a news item.'));
                }
                $model->delete();

                // display success message
                $this->_getSession()->addSuccess(
                    Mage::helper('study_news')->__('The news item has been deleted.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addException($e,
                    Mage::helper('study_news')->__('An error occured while deleting the news item.')
                );
            }
        }

        // go to grid
        $this->_redirect('*/*/');
    }

    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        switch ($this->getRequest()->getActionName()){
            case 'new':
            case 'save':
                return Mage::getSingleton('Admin/session')->isAllowed('news/news/save');
                break;
            case 'delete':
                return Mage::getSingleton('Admin/session')->isAllowed('news/news/delete');
                break;
            default:
                return Mage::getSingleton('Admin/session')->isAllowed('news/news');
                break;
        }
    }

    /**
     * Filtering posted data. Converting localized data if needed
     *
     * @param array
     * @return array
     */
    protected function _filterPostData($data)
    {
        $data = $this->_filterDates($data, array('time_published'));
        return $data;
    }

    /**
     * Grid ajax action
     */
    public function gridAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function productsAction()
    {
        $this->_initNews();

        if (!Mage::registry('current_study_news') || !Mage::registry('current_study_news')->getId()) {
            return $this->_redirect('*/*/');
        }
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    public function productsgridAction()
    {
        $this->_initNews();

        if (!Mage::registry('current_study_news') || !Mage::registry('current_study_news')->getId()) {
            return $this->_redirect('*/*/');
        }
        $this->loadLayout();
        $this->renderLayout();
        return $this;
    }

    /**
     * Flush News Posts Images Cache action
     */
    public function flushAction()
    {
        if(Mage::helper('study_news/image')->flushImaesCache()){
            $this->_getSession()->addSuccess('Cache successfully flushed');
        } else {
            $this->_getSession()->addError('There was error during flushing cache');
        }
        $this->_forward('index');
    }

    public function relatedAction()
    {
        $this->_initNews();

        if (!Mage::registry('current_study_news') || !Mage::registry('current_study_news')->getId()) {
            return $this->_redirect('*/*/');
        }
        $this->loadLayout();
        $this->renderLayout();

        return $this;

    }

    public function relatedgridAction()
    {
        $this->_initNews();

        if (!Mage::registry('current_study_news') || !Mage::registry('current_study_news')->getId()) {
            return $this->_redirect('*/*/');
        }
        $this->loadLayout();
        $this->renderLayout();

        return $this;
    }

}
