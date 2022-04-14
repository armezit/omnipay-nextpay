<?php

/**
 * @package Omnipay\Nextpay
 * @author Armin Rezayati <armin.rezayati@gmail.com>
 */

namespace Omnipay\Nextpay\Message;

/**
 * Class VerifyOrderResponse
 */
class VerifyOrderResponse extends AbstractResponse
{

    /**
     * @inheritDoc
     */
    public function getTransactionReference()
    {
        return $this->request->getTransactionReference();
    }

    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        return $this->getCode() === 200 && $this->data['code'] === 0;
    }

    /**
     * @inheritDoc
     */
    public function isCancelled()
    {
        return $this->getCode() === 200 && $this->data['code'] !== 0;
    }

}
