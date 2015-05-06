<?php
/**
 * News List Admin edit form tabs block
 *
 * @author HausO
 */
class Study_News_Block_Adminhtml_News_Edit_Tabs
    extends Mage_Adminhtml_Block_Widget_Tabs
{
    /**
     * Initialze tabs and define tabs block settings
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('page_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('study_news')->__('News Item Info'));
    }
}
