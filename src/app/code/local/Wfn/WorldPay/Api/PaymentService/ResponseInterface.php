<?php
/**
 * Interface Wfn_WorldPay_Api_PaymentService_ResponseInterface
 */
interface Wfn_WorldPay_Api_PaymentService_ResponseInterface
{
    /**
     * Whether or not the order was successful.
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
