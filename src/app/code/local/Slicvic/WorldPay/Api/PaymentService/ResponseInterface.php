<?php
/**
 * Interface Slicvic_WorldPay_Api_PaymentService_ResponseInterface
 */
interface Slicvic_WorldPay_Api_PaymentService_ResponseInterface
{
    /**
     * Whether or not the request was successful.
     *
     * @return bool
     */
    public function isSuccess();

    /**
     * Get the success or error message.
     *
     * @return string
     */
    public function getMessage();
}
