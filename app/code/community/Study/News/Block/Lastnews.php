<?php
/**
 * Last News Widget
 */

class Study_News_Block_Lastnews
    extends Mage_Core_Block_Template
    implements Mage_Widget_Block_Interface
{
/*
    protected function _toHtml()
    {

        $newsCollection = Mage::getModel('study_news/news')
            ->getResourceCollection()
            ->setOrder('published_at', 'desc');
        $newsCollection->getSelect()->limit(3,0);

        $html = '<div id="widget-lastnews">';
        $html .= '<div class="block-title">'
            . $this->__('Last News')
            . '</div>'
        ;

        foreach($newsCollection AS $news){
            $html .= '<div class="block-content">'
                . $news->getTitle()
                . '</div>'
            ;
        }

        $html .= '</div>';

        return $html;

    }
*/

    protected function _toHtml()
    {
        parent::_toHtml();

        $searchCollection = Mage::getModel('catalogsearch/query')
            ->getResourceCollection()
            ->setOrder('popularity', 'desc');
        $searchCollection->getSelect()->limit(3,0);
        $html  = '<div id="widget-topsearches-container">' ;
        $html .= '<div class="widget-topsearches-title">Top Search Terms</div>';

        foreach($searchCollection as $search){
            $html .= '<div class="widget-topsearches-searchtext">' . $search->query_text . "</div>";
        }
        $html .= "</div>";
        return $html;
    }

}
