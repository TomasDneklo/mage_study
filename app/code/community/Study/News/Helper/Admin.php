<?php
/**
 * News Admin helper
 *
 * @author HausO
 */
class Study_News_Helper_Admin
    extends Mage_Core_Helper_Abstract
{
    /**
     * Check permission for passed action
     *
     * @param string $controller
     * @param string $action
     * @return bool
     */
    public function isActionAllowed($controller, $action)
    {
        return Mage::getSingleton('admin/session')
            ->isAllowed('news/' . $controller . '/' . $action);
    }
}


