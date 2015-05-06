<?php
/**
 * News List Admin grid container
 *
 *
 */

class Study_News_Block_Adminhtml_News
    extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    /**
     * Block constructor
     */
    public function __construct()
    {
        $this->_blockGroup = 'study_news';
        $this->_controller = 'adminhtml_news';
        $this->_headerText = Mage::helper('study_news')->__('Manage News');

        parent::__construct();

        if(Mage::helper('study_news/admin')->isActionAllowed('save'))
        {
            $this->_updateButton('add', 'label',
                Mage::helper('study_news')->__('Add New News'));
        } else {
            $this->removeButton(
                'news_flush_image_cache',
                array(
                    'label'     => Mage::helper('study_news')->__('Flush Image Cache'),
                    'onclick'   => 'setLocation(\'' . $this->getUrl('*/*/flush') . '\')',
                )
            );
        }
    }
}
