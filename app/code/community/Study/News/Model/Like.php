<?php
/**
 *
 */
class Study_News_Model_Like extends Mage_Core_Model_Abstract
{
    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init('study_news/like');
    }


    /**
     * Load liked news by customer
     *
     * @param mixed $customer
     * @return Study_News_Model_Like
     */
    /*
    public function getNewsByCustomer($customer)
    {
        if ($customer instanceof Mage_Customer_Model_Customer) {
            $customer = $customer->getId();
        }

        $customer_id = (int) $customer;

        $this->_getResource()->getLikedNewsByCustomer($customer_id);

        return $this;
    }
    */

}

