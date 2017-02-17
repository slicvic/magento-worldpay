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
    protected $_canCapture = true;

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
            ->setOrderCode($order->getIncrementId())
            ->setDescription('Order # ' . $order->getIncrementId())
            ->setAmount($amount)
            ->setCardType($payment->getCcType())
            ->setCardNumber($payment->getCcNumber())
            ->setCardExpiryMonth($payment->getCcExpMonth())
            ->setCardExpiryYear($payment->getCcExpYear())
            ->setCardCvc($payment->getCcCid())
            ->setCardHolderName($billingAddress->getFirstname() . ' ' . $billingAddress->getLastname())
            ->setSessionId(Mage::getSingleton('core/session')->getEncryptedSessionId())
            ->setShopperIpAddress((isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '')
            ->send();

        //Mage::log($request->asXml() . "\n\n", null, $this->_code . '.log');
        //Mage::log(var_export($response, true) . "\n\n", null, $this->_code . '.log');

        if (!$response->isSuccess()) {
            Mage::throwException('Gateway Error: ' . $response->getMessage());
        }

        $payment->setIsTransactionClosed(1);
    }

    /**
     * {@inheritdoc}
     */
    public function capture(Varien_Object $payment, $amount)
    {
        $this->authorize($payment, $amount);
    }
}
