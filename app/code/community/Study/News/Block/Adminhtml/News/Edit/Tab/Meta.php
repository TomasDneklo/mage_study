<?php
/**
 * News List Admin edit form Meta Tab
 *
 * @author HausO@NEKLO
 */
class Study_News_Block_Adminhtml_News_Edit_Tab_Meta
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Prepare form element for Tab
     *
     * @return Mage_Adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::helper('study_news')->getNewsItemInstance();

        /**
         * checking if user have permission to save information
         */

        if(Mage::helper('study_news/admin')->isActionAllowed('save')){
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('news_meta_');

        $fieldset = $form->addFieldset('meta_fieldset', array(
            'legend' => Mage::helper('study_news')->__('News Meta Info')
        ));

        $fieldset->addField('meta_title', 'text', array(
            'name'      => 'meta_title',
            'label'     => Mage::helper('study_news')->__('Meta Title'),
            'title'     => Mage::helper('study_news')->__('Meta Title'),
            'disabled'  => $isElementDisabled
        ));

        $fieldset->addField('meta_description', 'text', array(
            'name' => 'meta_description',
            'label' => Mage::helper('study_news')->__('Meta Description'),
            'title' => Mage::helper('study_news')->__('Meta Description'),
            'disabled' => $isElementDisabled
        ));

        Mage::dispatchEvent('adminhtml_news_edit_tab_meta_prepare_form',
            array('form' => $form));

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
        return Mage::helper('study_news')->__('Meta Info');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('study_news')->__('Meta Info');
    }

    /**
     * Returns status flag about this tab can be shown or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }

}
