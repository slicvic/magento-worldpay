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
        $orderDescription = [];
        foreach ($order->getAllVisibleItems() as $item) {
            $orderDescription[] = $item->getQtyOrdered() . ' ' . $item->getName();
        }
        $request = new Wfn_WorldPay_Api_PaymentService_Order_Request(
            $this->getConfigData('api_url'),
            $this->getConfigData('api_merchant_code'),
            $this->getConfigData('api_password')
        );

        $response = $request
            ->setOrderCode($order->getIncrementId().time())
            ->setDescription(implode(',', $orderDescription))
            ->setAmount(1)
            ->setCardType($payment->getCcType())
            ->setCardNumber($payment->getCcNumber())
            ->setCardExpiryMonth($payment->getCcExpMonth())
            ->setCardExpiryYear($payment->getCcExpYear())
            ->setCardCvc($payment->getCcCid())
            ->setCardHolderName($billingAddress->getFirstname() . ' ' . $billingAddress->getLastname())
            ->setSessionId(Mage::getSingleton('core/session')->getEncryptedSessionId())
            ->setShopperIpAddress((isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '')
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
