<?php

/**
 * @package Omnipay\Nextpay
 * @author Armin Rezayati <armin.rezayati@gmail.com>
 */

namespace Omnipay\Nextpay\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Class CreateOrderRequest
 */
class CreateTokenRequest extends AbstractRequest
{

    /**
     * @inheritDoc
     */
    protected function getHttpMethod()
    {
        return 'POST';
    }

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     * @throws InvalidRequestException
     */
    public function getData()
    {
        // Validate required parameters before return data
        $this->validate('apiKey', 'amount', 'currency', 'transactionId', 'returnUrl');

        return [
            'api_key' => $this->getApiKey(),
            'order_id' => $this->getTransactionId(),
            'amount' => $this->getAmount(),
            'callback_uri' => $this->getReturnUrl(),
            'currency' => $this->getCurrency(),
            'customer_phone' => $this->getCustomerPhone(),
            'custom_json_fields' => $this->getMeta(),
            'payer_name' => $this->getPayerName(),
            'payer_desc' => $this->getPayerDesc(),
            'auto_verify' => $this->getAutoVerify(),
            'allowed_card' => $this->getAllowedCard(),
        ];
    }

    /**
     * @param string $endpoint
     * @return string
     */
    protected function createUri(string $endpoint)
    {
        return $endpoint . '/token';
    }

    /**
     * @param array $data
     * @return CreateTokenResponse
     */
    protected function createResponse(array $data)
    {
        return new CreateTokenResponse($this, $data);
    }
}
