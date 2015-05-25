<?php
/**
 * News List Admin edit form image tab
 *
 * @author HausO
 */
class Study_News_Block_adminhtml_News_Edit_Tab_Image
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Prepare form elements
     *
     * @return Mage_adminhtml_Block_Widget_Form
     */
    protected function _prepareForm(){
        /**
         * Checking if user have permission to save information
         */
        if(Mage::helper('study_news/admin')->isActionAllowed('news', 'save')){
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('news_image_');

        $model = Mage::helper('study_news')->getNewsItemInstance();

        $fieldset = $form->addFieldset('image_fieldset', array(
            'legend' =>Mage::helper('study_news')->__('Image Thumbnail'), 'class' => 'fieldset-wide'
        ));

        $this->_addElementTypes($fieldset);

        $fieldset->addField('image', 'image', array(
            'name'      => 'image',
            'label'     => Mage::helper('study_news')->__('Image'),
            'title'     => Mage::helper('study_news')->__('Image'),
            'required'  => false,
            'disabled'  => $isElementDisabled
        ));

        Mage::dispatchEvent('adminhtml_news_edit_tab_image_prepare_form', array('form' => $form));

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('study_news')->__('Image Thumbnail');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('study_news')->__('Image Thumbnail');
    }

    /**
     * Return status flag about this tab can be shown or not
     *
     * $return true
     */
    public function canShowTab(){
        return true;
    }

    /**
     * Return status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }


    /**
     * Return predefiend additional elemnet types
     *
     * @return array
     */
    protected function _getAdditionalElementTypes()
    {
        return array(
            'image' => Mage::getConfig()->getBlockClassName('study_news/adminhtml_news_edit_form_element_image')
        );
    }
}
