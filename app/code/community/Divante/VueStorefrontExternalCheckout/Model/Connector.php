<?php
require_once(__DIR__ . '/../helpers/JWT.php');
/**
 * Class Divante_VueStorefrontExternalCheckout_Model_Connector
 */
class Divante_VueStorefrontExternalCheckout_Model_Connector
{
    /**
     * @param $token
     *
     * @return Mage_Core_Model_Abstract|null
     */
    public function currentCustomer($token)
    {
        $secretKey = trim(Mage::getConfig()->getNode('default/auth/secret'));

        try {
            $tokenData = JWT::decode($token, $secretKey, 'HS256');
            if ($tokenData->id > 0) {
                return Mage::getModel('customer/customer')->load($tokenData->id);
            } else {
                return null;
            }
        } catch (Exception $err) {
            return null;
        }

        return null;
    }

    /**
     * @param $cartId
     *
     * @return Mage_Core_Model_Abstract|null
     */
    public function currentQuote($cartId)
    {
        if (intval(($cartId)) > 0) {
            return Mage::getModel('sales/quote')->load($cartId);
        } else {
            if ($cartId) {
                $secretKey = trim(Mage::getConfig()->getNode('default/auth/secret'));
                $tokenData = JWT::decode($cartId, $secretKey, 'HS256');

                return Mage::getModel('sales/quote')->load($tokenData->cartId);
            } else {
                return null;
            }
        }
    }
}
