<?php
/**
 * Custom image form element that generates correnct thumbnail image URL
 *
 * @author HausO
 */
class Study_News_Block_Adminhtml_News_Edit_Form_Element_Image
    extends Varien_Data_Form_Element_Image
{
    /**
     * Get image preview url
     *
     * @return string
     */
    protected function _getUrl(){
        $url = false;
        if($this->getValue()){
            $url = Mage::helper('study_news/image')->getBaseUrl() . '/'
                . $this->getValue();
        }
        return $url;
    }
}

