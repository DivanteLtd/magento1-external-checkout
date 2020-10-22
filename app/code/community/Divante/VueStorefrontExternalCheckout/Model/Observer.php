<?php

/**
 * Class Divante_VueStorefrontExternalCheckout_Model_Observer
 */
class Divante_VueStorefrontExternalCheckout_Model_Observer
{

    const EXTERNALCHECKOUT_URL = 'vuestorefrontexternalcheckout/vuestorefrontexternalcheckout_group/externalcheckout_url';
    const REDIRECT_ALL = 'vuestorefrontexternalcheckout/vuestorefrontexternalcheckout_group/redirect_all';
    const EXCLUDE_ROUTE = 'vuestorefrontexternalcheckout/vuestorefrontexternalcheckout_group/exclude_route';
    const VUESTOREFRONT_URL ='vuestorefrontexternalcheckout/vuestorefrontexternalcheckout_group/vuestorefront_url';

    /**
     * Redirect after success order placed
     *
     * @param $observer
     *
     * @throws Mage_Core_Model_Store_Exception
     */
    public function redirectAfter($observer)
    {
        $configRedirect = Mage::getStoreConfig(SELF::VUESTOREFRONT_URL,Mage::app()->getStore()).DS.Mage::getStoreConfig(SELF::EXTERNALCHECKOUT_URL,Mage::app()->getStore());

        if ($configRedirect && $configRedirect != '') {
            header("Location: " . $configRedirect);
            die();
        }
    }

    /**
     * @param Varien_Event_Observer $observer
     * @return $this
     *
     */
    public function preDispatch(Varien_Event_Observer $observer)
    {
        $request = Mage::app()->getRequest();
        $module = $request->getControllerModule();

        $controller = $request->getControllerName();
        $action = $request->getActionName();
        $route = $request->getRouteName();
        $path = $route.DS.$controller.DS.$action;

        $exclude_routes = preg_split('/\r\n|[\r\n]/', Mage::getStoreConfig(SELF::EXCLUDE_ROUTE,Mage::app()->getStore()));

        if(!Mage::getStoreConfig( SELF::REDIRECT_ALL,Mage::app()->getStore() )){
            return $this;
        } else {

            if ($module == 'Divante_VueStorefrontExternalCheckout' || $module == 'Divante_VueStorefrontBridge') {
                return $this;
            }
            foreach($exclude_routes as $exclude) {
                if (strpos($path, $exclude) !== false) {
                    return $this;
                }
            }

            // Force an interruption of the controller dispatching,
            // to prevent the requested action from being executed.
            // If only a redirect is defined, the action will still be executed.
            $exception = new Mage_Core_Controller_Varien_Exception();
            $exception->prepareForward('redirect', 'redirect', 'vue');
            throw $exception;
        }

    }
}
