<?php

class Divante_VueStorefrontExternalCheckout_RedirectController extends Mage_Core_Controller_Front_Action
{
    /**
     * Redirect to the vue storefront url.
     */
    public function redirectAction()
    {
        $configPath = Divante_VueStorefrontExternalCheckout_Model_Observer::VUESTOREFRONT_URL;
        $vsf_url = Mage::getStoreConfig($configPath, Mage::app()->getStore());

        $this->_redirectUrl($vsf_url);
    }
}
