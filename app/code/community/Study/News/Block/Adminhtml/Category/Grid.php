<?php
/**
 * News List Admin grid
 *
 *
 */
class Study_News_Block_Adminhtml_Category_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Init Grid default properties
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('news_category_grid');
        $this->setDefaultSort('name');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * Prepare collection for Grid
     *
     * @return Study_News_Block_Adminhtml_News_Grid
     */
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('study_news/category')->getResourceCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    /**
     * Prepare Grid columns
     *
     * @return Mage_Adminhtml_Block_Catalog_Search_Grid
     */
    protected function _prepareColumns()
    {
        $this->addColumn('category_id', array(
            'header' => Mage::helper('study_news')->__('ID'),
            'width' => '150px',
            'index' => 'category_id',
        ));

        $this->addColumn('name', array(
            'header' => Mage::helper('study_news')->__('Category Name'),
            'index' => 'name',
        ));

        $this->addColumn('action', array(
            'header' => Mage::helper('study_news')->__('Action'),
            'width' => '100px',
            'type' => 'action',
            'getter' => 'getId',
            'actions' => array(array(
                'caption' => Mage::helper('study_news')->__('Edit'),
                'url' => array('base' => '*/*/edit'),
                'field' => 'id'
            )),
            'filter' => false,
            'sortable' => false,
            'index' => 'news',
        ));

        return parent::_prepareColumns();
    }

    /**
     * Return row URL for js event handlers
     *
     * @param $row
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

    /**
     * Grid url getter
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }
}
