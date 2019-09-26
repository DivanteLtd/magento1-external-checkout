# Magento 1.9 External Checkout for Vue Storefront

This Magento extension allow You to merge given shopping cart with current's user session. It performs a auto-login if user-token provided.

This module is designed to work with: [Vue Storefront External Checkout](https://github.com/Vendic/vsf-external-checkout).

This extension allows the user to start the session within the Vue Storefront shop and finalize the order in Magento1. It's great when You have very extended/customized Magento checkout which will be hard to port to Vue Storefront.

![External checkout for Vue Storefront](https://github.com/filrak/vsf-external-checkout/raw/master/diagram.png)


## Installation guide

1. Copy the module files from the repo to `app/*`
2. Please install the [`vsf-external-checkout`](https://github.com/Vendic/vsf-external-checkout) module for Vue Storefront. [See the instruction](https://github.com/Vendic/vsf-external-checkout).
3. Go to: Stores -> Configuration | VueStorefront -> External Checkout and set URL
4. if you want to redirect all other Magento Pages to VueStorefront activate Redirect to VSF homepage
5. set exclude routes if needed

To test if Your extension works just fine, You can test the following URL:
* http://your-base-magento-address.io/vue/cart/sync/token/{customer-api-token}/cart/{cartId}

For example, our test address looks like:
* http://demo-magento2.vuestorefront.io/vue/cart/sync/token/s7nirf24cxro7qx1hb9uujaq4jx97nvp/cart/3648

where
* `s7nirf24cxro7qx1hb9uujaq4jx97nvp` is a customer token provided by [`POST /V1/integration/customer/token`](http://devdocs.magento.com/guides/v2.0/get-started/authentication/gs-authentication-token.html) or can be empty!
* `3648` is a quote id; for guest-carts it will be not integer but guid string

## Credits

Mateusz Bukowski (@gatzzu)
