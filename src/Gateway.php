<?php

/**
 * @package Omnipay\Nextpay
 * @author Armin Rezayati <armin.rezayati@gmail.com>
 */

namespace Omnipay\Nextpay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\Nextpay\Message\CreateTokenRequest;
use Omnipay\Nextpay\Message\RefundOrderRequest;
use Omnipay\Nextpay\Message\VerifyOrderRequest;

/**
 * Class Gateway
 */
class Gateway extends AbstractGateway
{
    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     * @return string
     */
    public function getName(): string
    {
        return 'Nextpay';
    }

    /**
     * @return array
     */
    public function getDefaultParameters(): array
    {
        return [
            'testMode' => false,
            'apiKey' => '',
            'returnUrl' => '',
            'currency' => 'IRT', // either IRT or IRR
        ];
    }

    /**
     * @inheritDoc
     */
    public function initialize(array $parameters = [])
    {
        parent::initialize($parameters);
        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey(): ?string
    {
        return $this->getParameter('apiKey');
    }

    /**
     * @return string
     */
    public function getReturnUrl(): ?string
    {
        return $this->getParameter('returnUrl');
    }

    /**
     * @param string $value
     * @return self
     */
    public function setApiKey(string $value): self
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     * @param string $value
     * @return self
     */
    public function setReturnUrl(string $value): self
    {
        return $this->setParameter('returnUrl', $value);
    }

    /**
     * @inheritDoc
     */
    public function purchase(array $options = []): RequestInterface
    {
        return $this->createRequest(CreateTokenRequest::class, $options);
    }

    /**
     * @inheritDoc
     */
    public function completePurchase(array $options = []): RequestInterface
    {
        return $this->createRequest(VerifyOrderRequest::class, $options);
    }

    /**
     * @inheritDoc
     */
    public function refund(array $options = []): RequestInterface
    {
        return $this->createRequest(RefundOrderRequest::class, $options);
    }

    /**
     * Return the key of transaction reference in returned responses of the gateway
     * @return string
     */
    public function getTransactionReferenceKey(): string
    {
        return 'trans_id';
    }

}
