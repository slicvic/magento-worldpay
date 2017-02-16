<?php
/**
 * Payment method that inherits from CC, to reuse form block and
 * info block.
 */
class Wfn_WorldPay_Model_Method_Cc extends Mage_Payment_Model_Method_Cc
{
    /**
     * {@inheritdoc}
     */
    protected $_code = 'wfn_worldpay';

    /**
     * {@inheritdoc}
     */
    protected $_canAuthorize = true;

    /**
     * {@inheritdoc}
     */
    protected $_canCapture = false;

    /**
     * {@inheritdoc}
     */
    public function authorize(Varien_Object $payment, $amount)
    {
        $order = $payment->getOrder();
        $billingAddress = $order->getBillingAddress();

        $request = new Wfn_WorldPay_Api_PaymentService_Order_Request(
            $this->getConfigData('api_url'),
            $this->getConfigData('api_merchant_code'),
            $this->getConfigData('api_password')
        );

        $response = $request
            ->setOrderNumber($order->getIncrementId())
            ->setAmount(1)
            ->setCcType($payment->getCcType())
            ->setCcNumber($payment->getCcNumber())
            ->setCcExpiryMonth($payment->getCcExpMonth())
            ->setCcExpiryYear($payment->getCcExpYear())
            ->setCcCvc($payment->getCcCid())
            ->setCustomerEmail($order->getCustomerEmail())
            ->setBillingName($billingAddress->getFirstname() . ' ' . $billingAddress->getLastname())
            ->setBillingAddress1($billingAddress->getStreet(-1))
            ->setBillingCity($billingAddress->getCity())
            ->setBillingState($billingAddress->getRegion())
            ->setBillingPostalCode($billingAddress->getPostcode())
            ->setBillingTelephone($billingAddress->getTelephone())
            ->setSessionId(Mage::getSingleton('core/session')->getEncryptedSessionId())
            ->setCustomerIpAddress((isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '')
            ->setBrowserAcceptHeader((isset($_SERVER['HTTP_ACCEPT'])) ? $_SERVER['HTTP_ACCEPT'] : '')
            ->setBrowserUserAgentHeader((isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '')
            ->send();
        print_r($response);
        echo $request->toXmlString();

        if (false === $response) {
            Mage::throwException('Error: cURL returned false');
        }

        if ($response->head->title) {
            Mage::throwException('Error: ' . (string) $response->head->title);
        }

        if ($response->reply->error) {
            Mage::throwException('Error: Error code ' . (string) $response->reply->error['code']);
        }


//print_r($response->head->title);
        Mage::throwException('xxx');
    }

    /**
     * {@inheritdoc}
     */
    public function capture(Varien_Object $payment, $amount)
    {
        $this->authorize($payment, $amount);
    }
}
