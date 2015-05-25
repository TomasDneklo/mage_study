<?php
/**
 * News List Admin edit form block
 *
 *
 */
class Study_News_Block_Adminhtml_Category_Edit_Form
    extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * @return Study_News_Model_Category
     */
    protected function _getCategory()
    {
        return Mage::registry('current_study_news_category');
    }

    /**
     * Prepare form action
     *
     * @return Study_News_Block_Adminhtml_Category_Edit_Form
     */
    protected function _prepareForm()
    {

        $model = Mage::helper('study_news')->getNewsCategoryInstance();

        /**
         * Checking if user have permission to save information
         */
        if(Mage::helper('study_news/admin')->isActionAllowed('category', 'save')){
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save'),
            'method'    => 'post',
            'enctype'   => 'multipart/form-data'
        ));

        $form->setUseContainer(true);

        $form->setHtmlIdPrefix('news_category_');

        $fieldset = $form->addFieldset('base_fieldset', array(
                'legend' => Mage::helper('study_news')->__('News Category')
            )
        );

        if($model->getId()){
            $fieldset->addField('category_id', 'hidden', array(
                'name' => 'category_id',
            ));
        }

        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => Mage::helper('study_news')->__('Category Name'),
            'title'     => Mage::helper('study_news')->__('Category Name'),
            'required'  => true,
            'disabled'  => $isElementDisabled
        ));

        $fieldset->addField('news', 'multiselect', array(
            'name'      => 'news',
            'label'     => Mage::helper('study_news')->__('News'),
            'title'     => Mage::helper('study_news')->__('News'),
            'values'    => $this->_getNewsList(),
            'value'     => $this->_getLinkedNewsIds()
        ));

        $this->setForm($form);
        $form->setValues($model->getData());

        return parent::_prepareForm();
    }

    protected function _getNewsList()
    {

        $newsCollection = Mage::getModel('study_news/news')->getCollection();
        $newsCollection->setOrder('title', 'asc');

        $newsList = array();

        foreach($newsCollection AS $news){
            $newsList[] = array(
                'value' => $news->getId(),
                'label' => $news->getTitle()
            );
        }

        return $newsList;
    }

    protected function _getLinkedNewsIds()
    {
        $linked = array();
        if($categoryId = $this->_getCategory()->getId()) {
            $linked = Mage::getModel('study_news/category_link')
                ->getLinkedNewsIds($categoryId);
        }

        return $linked;
    }
}

