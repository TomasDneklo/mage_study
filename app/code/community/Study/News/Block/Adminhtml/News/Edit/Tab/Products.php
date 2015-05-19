<?php
class Study_News_Block_Adminhtml_News_Edit_Tab_Products
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function getTabLabel()
    {
        return $this->__('Products');
    }

    public function getTabTitle()
    {
        return $this->__('Products');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }

    public function getTabUrl()
    {
        return $this->getUrl('*/*/products', array('_current' => true));
    }

    public function getTabClass()
    {
        return 'ajax';
    }
}