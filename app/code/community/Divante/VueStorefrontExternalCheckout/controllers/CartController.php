<?php
class Divante_VueStorefrontExternalCheckout_CartController extends Mage_Core_Controller_Front_Action {

    public function syncAction($coreRoute = null)
    {


        $customerToken = $this->getRequest()->getParam('token');
        $cartId = $this->getRequest()->getParam('cart');
        $connectorModel = Mage::getModel('vuestorefrontexternalcheckout/connector');

        if (!$customerToken || $customerToken == '') {
            /**
             * Quest user
             */
            $quote = Mage::getSingleton('checkout/session');
            $quote->resetCheckout();
            $quote->replaceQuote($connectorModel->currentQuote($cartId));
        } else {
            $session = Mage::getSingleton('customer/session');
            $session->loginById($connectorModel->currentCustomer($customerToken)->getId());
            $quote = Mage::getSingleton('checkout/session');
            $quote->resetCheckout();
            $quote->replaceQuote($connectorModel->currentQuote($cartId));
        }

        $this->_redirect('checkout/onepage');
    }
}
