<?php
/**
 * News List Admin edit form container
 *
 *
 */
class Study_News_Block_Adminhtml_News_Edit
    extends Mage_Adminhtml_Block_Widget_Form_Container
{
    /**
     * Initialize edit from container
     *
     */
    public function __construct()
    {
        $this->_objectId    = 'id';
        $this->_blockGroup  = 'study_news';
        $this->_controller  = 'adminhtml_news';

        parent::__construct();

        if(Mage::helper('study_news/admin')->isActionAllowed('category', 'save')) {
            $this->_updateButton('save', 'label',
                Mage::helper('study_news')->__('Save News Item'));
            $this->_addButton('saveandcontinue', array(
                'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
                'onclick'   => 'saveAndContinueEdit()',
                'class'     => 'save',
                ), -100);
        } else {
            $this->_removeButton('save');
        }

        if(Mage::helper('study_news/admin')->isActionAllowed('category', 'delete')){
            $this->_updateButton('delete', 'label',
                Mage::helper('study_news')->__('Delete News Item'));
        } else {
            $this->_removeButton('delete');
        }

        $this->_formScripts[] = "
            function toggleEditor(){
                if(tinyMCE.getInstanceById('page_content') == null){
                    tinyMCE.execCommand('mceAddControl', false, 'page_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'page_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    /**
     * Retrive text for heade element depending on loaded page
     *
     * @return string
     */
    public function getHeaderText()
    {
        $model = Mage::helper('study_news')->getNewsItemInstance();
        if($model->getId()){
            return Mage::helper('study_news')->__("Edit News Item '%s'",
                $this->escapeHtml($model->getTitle()));
        } else {
            return Mage::helper('study_news')->__('New News Item');
        }
    }
}

