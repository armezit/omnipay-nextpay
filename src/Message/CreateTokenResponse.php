<?php

/**
 * @package Omnipay\Nextpay
 * @author Armin Rezayati <armin.rezayati@gmail.com>
 */

namespace Omnipay\Nextpay\Message;

use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Class CreateOrderResponse
 */
class CreateTokenResponse extends AbstractResponse implements RedirectResponseInterface
{

    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        return $this->getHttpStatus() === 200 && $this->getCode() === -1;
    }

    /**
     * @inheritDoc
     */
    public function isRedirect()
    {
        return $this->getCode() === -1 &&
            isset($this->data['trans_id']) &&
            !empty($this->data['trans_id']);
    }

    /**
     * @inheritDoc
     */
    public function getRedirectUrl()
    {
        return sprintf('%s/payment/%s', $this->request->getEndpoint(), $this->getTransactionReference());
    }

    /**
     * @inheritDoc
     */
    public function getTransactionId()
    {
        return $this->request->getTransactionId();
    }

    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        return $this->data['trans_id'];
    }

}
