<?php
/**
 * Interface Wfn_WorldPay_Api_PaymentService_RequestInterface
 */
interface Wfn_WorldPay_Api_PaymentService_RequestInterface
{
    /**
     * Convert request to XML string.
     *
     * @return string
     */
    public function asXml();

    /**
     * Send HTTP request.
     *
     * @return false|string
     */
    public function send();
}
