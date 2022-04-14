<?php

/**
 * @package Omnipay\Nextpay
 * @author Armin Rezayati <armin.rezayati@gmail.com>
 */

namespace Omnipay\Nextpay\Message;

/**
 * Class InquiryOrderResponse
 */
class RefundOrderResponse extends AbstractResponse
{

    /**
     * @inheritDoc
     */
    public function isSuccessful()
    {
        return $this->getCode() === 200 && $this->data['code'] === -90;
    }

}
