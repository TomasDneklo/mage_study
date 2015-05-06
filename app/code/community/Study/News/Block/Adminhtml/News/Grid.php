<?php
/**
 * News List Admin grid
 *
 *
 */
class Study_News_Block_Adminhtml_News_Grid
    extends Mage_Adminhtml_Block_Widget_Grid
{
    /**
     * Init Grid default properties
     *
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('news_list_grid');
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');
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
        $collection = Mage::getModel('study_news/news')->getResourceCollection();
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
        $this->addColumn('news_id', array(
            'header' => Mage::helper('study_news')->__('ID'),
            'width' => '50px',
            'index' => 'news_id',
        ));

        $this->addColumn('title', array(
            'header' => Mage::helper('study_news')->__('News Title'),
            'index' => 'title',
        ));

        $this->addColumn('author', array(
            'header' => Mage::helper('study_news')->__('Author'),
            'index' => 'author',
        ));

        $this->addColumn('published_at', array(
            'header' => Mage::helper('study_news')->__('Published ON'),
            'sortable' => true,
            'width' => '170px',
            'index' => 'published_at',
            'type' => 'date',
        ));

        $this->addColumn('created_at', array(
            'header' => Mage::helper('study_news')->__('Created'),
            'sortable' => true,
            'width' => '170px',
            'index' => 'created_at',
            'type' => 'datetime',
        ));
/*
        $this->addColumn('meta_title', array(
            'header' => Mage::helper('study_news')->__('News Meta Title'),
            'index' => 'meta_title',
        ));

        $this->addColumn('meta_description', array(
            'header' => Mage::helper('study_news')->__('News Meta Description'),
            'index' => 'meta_description',
        ));
*/
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
