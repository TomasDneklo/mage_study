<?php
/**
 * News List Admin edit form main tab
 *
 * @author HausO
 */
class Study_News_Block_Adminhtml_News_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Prepare form element for tab
     *
     * @return Mage_adminhtml_Block_Widget_Form
     */
    protected function _prepareForm()
    {
        $model = Mage::helper('study_news')->getNewsItemInstance();

        /**
         * Checking if user have permission to save information
         */
        if(Mage::helper('study_news/admin')->isActionAllowed('save')){
            $isElementDisabled = false;
        } else {
            $isElementDisabled = true;
        }

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('news_main_');

        $fieldset = $form->addFieldset('base_fieldset', array(
                'legend' => Mage::helper('study_news')->__('News Item Info')
            )
        );

        if($model->getId()){
            $fieldset->addField('news_id', 'hidden', array(
                'name' => 'news_id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('study_news')->__('News Title'),
            'title'     => Mage::helper('study_news')->__('News Title'),
            'required'  => true,
            'disabled'  => $isElementDisabled
        ));

        $fieldset->addField('author', 'text', array(
            'name'      => 'author',
            'label'     => Mage::helper('study_news')->__('Author'),
            'title'     => Mage::helper('study_news')->__('Author'),
            'required'  => true,
            'disabled'  => $isElementDisabled
        ));

        $fieldset->addField('published_at', 'date', array(
            'name'      => 'published_at',
            'format'    => Mage::app()->getLocale()->getDateFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
            'image'     => $this->getSkinUrl('images/grid-cal.gif'),
            'label'     => Mage::helper('study_news')->__('Publishing Date'),
            'title'     => Mage::helper('study_news')->__('Publishing Date'),
            'required'  => true
        ));

        Mage::dispatchEvent('adminhtml_news_edit_tab_main_prepare_form', array('form' => $form));

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
        return Mage::helper('study_news')->__('News Info');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('study_news')->__('News Info');
    }

    /**
     * Return status flag abut this tab can be shown or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Return status flag about tab is hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }
}
