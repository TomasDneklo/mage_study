<?php
/**
 * News controller
 *
 * @author HausO
 */
class Study_News_Adminhtml_CategoryController
    extends Mage_Adminhtml_Controller_Action
{

    /**
     * @param string $idFieldName
     *
     * @return $this
     */
    protected function _initCategory($idFieldName = 'id')
    {
        $this->_title($this->__('News Category'));

        $categoryId = (int) $this->getRequest()->getParam($idFieldName);

        $category = Mage::getModel('study_news/category');

        if ($categoryId) {
            $category->load($categoryId);
        }

        Mage::register('current_study_news_category', $category);

        return $this;
    }


    /**
     * Init actions
     *
     * @return Study_News_Adminhtml_CategoryController
     */
    protected function _initAction()
    {
        //load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('news/category')
            ->_addBreadcrumb(
                    Mage::helper('study_news')->__('News'),
                    Mage::helper('study_news')->__('News')
                )
            ->_addBreadcrumb(
                Mage::helper('study_news')->__('Manage News Categories'),
                Mage::helper('study_news')->__('Manage News Categories')
            );

        $this->_initCategory();

        return $this;
    }

    /**
     * Index action
     */
    public function indexAction(){
        $this->_title($this->__('News'))
            ->_title($this->__('Manage News Categories'));

        $this->_initAction();

        $this->renderLayout();
    }

    /**
     * Create News category
     */
    public function newAction()
    {
        // the same form is used to create and edit
        $this->_forward('edit');
    }

    /**
     * Edit News category
     */
    public function editAction()
    {
        $this->_title($this->__('News Category'))
            ->_title('Manage News Category');

        // 1. instance nes model
        /* @var $model Study_News_Model_Category */
        $model = Mage::getModel('study_news/category');

        // 2. if ID exists, check it and load data
        $categoryId = $this->getRequest()->getParam('id');
        if($categoryId){
            $model->load($categoryId);

            if(!$model->getId()){
                $this->_getSession()->addError(
                    Mage::helper('study_news')->__('News category does not exist.')
                );
                return $this->_redirect('*/*/');
            }
            // prepare title
            $this->_title($model->getName());
            $breadCrumb = Mage::helper('study_news')->__('Edit category');
        } else {
            $this->_title(Mage::helper('study_news')->__('New category'));
            $breadCrumb = Mage::helper('study_news')->__('New category');
        }

        // Init breadcrumbs
        $this->_initAction()->_addBreadCrumb($breadCrumb, $breadCrumb);

        // 3. Set entered data if there was an error during save
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if(!empty($data)){
            $model->addData($data);
        }

        // 4. Register model to use later in blocks
        Mage::register('news_category', $model);

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
            // init model and set data
            /* @var $model Study_News_Model_Category */
            $model = Mage::getModel('study_news/category');

            // if news category exists, try to load it
            $categoryId = $this->getRequest()->getParam('category_id');
            if($categoryId){
                $model->load($categoryId);
            }

            $model->addData($data);

            try {
                $hasError = false;

                $model->setData('news', $this->getRequest()->getParam('news'));

                // save the data
                $model->save();

                // dispay success message
                $this->_getSession()->addSuccess(
                    Mage::helper('study_news')->__('The news category has been saved.')
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
                    Mage::helper('study_news')->__('An Error occured while saveing news category.')
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
        $categoryId = $this->getRequest()->getParam('id');
        if ($categoryId) {
            try {
                // init model and delete
                /** @var $model Study_News_Model_Category */
                $model = Mage::getModel('study_news/category');
                $model->load($categoryId);
                if (!$model->getId()) {
                    Mage::throwException(Mage::helper('study_news')->__('Unabel to find a news category.'));
                }
                $model->delete();

                // display success message
                $this->_getSession()->addSuccess(
                    Mage::helper('study_news')->__('The news category has been deleted.')
                );
            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            } catch (Exception $e) {
                $this->_getSession()->addException($e,
                    Mage::helper('study_news')->__('An error occured while deleting the news category.')
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
                return Mage::getSingleton('Admin/session')->isAllowed('news/category/save');
                break;
            case 'delete':
                return Mage::getSingleton('Admin/session')->isAllowed('news/category/delete');
                break;
            default:
                return Mage::getSingleton('Admin/session')->isAllowed('news/category');
                break;
        }
    }

}
