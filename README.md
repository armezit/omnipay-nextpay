# Omnipay: Nextpay

**[NextPay](https://nextpay.org) driver for the Omnipay PHP payment processing library**

![Packagist Version](https://img.shields.io/packagist/v/armezit/omnipay-nextpay.svg)
![PHP from Packagist](https://img.shields.io/packagist/php-v/armezit/omnipay-nextpay.svg)
![Packagist](https://img.shields.io/packagist/l/armezit/omnipay-nextpay.svg)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP. This package implements Nextpay support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply require 
`league/omnipay` and `armezit/omnipay-nextpay` with Composer:

```
composer require league/omnipay armezit/omnipay-nextpay
```

## Basic Usage

The following gateways are provided by this package:

* NextPay

For general usage instructions, please see the main [Omnipay](https://github.com/omnipay/omnipay)
repository.

## Example

### Purchase

The result will be a redirect to the gateway or bank.

```php
use Omnipay\Omnipay;

$gateway = Omnipay::create('Nextpay');
$gateway->setApiKey('API_KEY');
$gateway->setReturnUrl('https://www.example.com/return');

// Send purchase request
$response = $gateway->purchase([
    'amount' => $amount,
    'currency' => $currency,
    'transactionId' => $orderId, // order_id on merchant side
])->send();

// Process response
if ($response->isSuccessful() && $response->isRedirect()) {
    // store the transaction reference to use in completePurchase()
    $transactionReference = $response->getTransactionReference();
    // Redirect to offsite payment gateway
    $response->redirect();
} else {
    // Payment failed: display message to customer
    echo $response->getMessage();
}
```

### Complete Purchase (Verify)

On return, the usual completePurchase will provide the result of the transaction attempt.

The final result includes the following methods to inspect additional details:

```php
// Send purchase complete request
$response = $gateway->completePurchase([
    'amount' => $amount,
    'transactionReference' => $transactionReference, 
])->send();

if (!$response->isSuccessful() || $response->isCancelled()) {
    // Payment failed: display message to customer
    echo $response->getMessage();
} else {
    // Payment was successful
    print_r($response);
}
```

### Refund Order

Refund an order by the $transactionReference:

```php
$response = $gateway->refund([
    'amount' => $amount,
    'transactionReference' => $transactionReference,
])->send();

if ($response->isSuccessful()) {
    // Refund was successful
    print_r($response);
} else {
    // Refund failed
    echo $response->getMessage();
}
```

### Testing

```sh
composer test
```

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/armezit/omnipay-nextpay/issues),
or better yet, fork the library and submit a pull request.
