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
    public function toXmlString();

    /**
     * Send HTTP request.
     *
     * @return false|SimpleXMLElement
     */
    public function send();
}