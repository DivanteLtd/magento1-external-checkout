<?php

/**
 * Class Divante_VueStorefrontExternalCheckout_Model_Observer
 */
class Divante_VueStorefrontExternalCheckout_Model_Observer
{
    /**
     * Redirect after success order placed
     *
     * @param $observer
     *
     * @throws Mage_Core_Model_Store_Exception
     */
    public function redirectAfter($observer)
    {
        $configRedirect =
            Mage::getStoreConfig(
                'vuestorefrontexternalcheckout/vuestorefrontexternalcheckout_group/externalcheckout_url',
                Mage::app()->getStore()
            );

        if ($configRedirect && $configRedirect != '') {
            header("Location: " . $configRedirect);
            die();
        }
    }
}
