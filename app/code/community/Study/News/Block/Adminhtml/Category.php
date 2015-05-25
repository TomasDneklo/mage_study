<?php
/**
 * News List Admin grid container
 *
 *
 */

class Study_News_Block_Adminhtml_Category
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Block constructor
     */
    public function __construct()
    {
        $this->_blockGroup = 'study_news';
        $this->_controller = 'adminhtml_category';
        $this->_headerText = Mage::helper('study_news')->__('Manage News Categories');

        parent::__construct();

        if(Mage::helper('study_news/admin')->isActionAllowed('category', 'save'))
        {
            $this->_updateButton('add', 'label',
                Mage::helper('study_news')->__('Add New Category'));
        }
    }
}
