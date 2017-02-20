<?php
/**
 * Class Wfn_WorldPay_Api_PaymentService_Order_Request
 */
class Wfn_WorldPay_Api_PaymentService_Order_Request extends Wfn_WorldPay_Api_PaymentService_AbstractRequest
{
    /**
     * Valid credit card types.
     *
     * @var array
     */
    protected static $cardTypes = [
        'VI' => 'VISA-SSL',
        'MC' => 'ECMC-SSL',
        'AE' => 'AMEX-SSL',
        'DI' => 'DISCOVER-SSL'
    ];

    /**
     * Request parameters.
     *
     * @var string
     */
    protected $orderCode;
    protected $description;
    protected $amount;
    protected $amountExponent = 2;
    protected $currencyCode = 'USD';
    protected $cardType;
    protected $cardNumber;
    protected $cardExpiryMonth;
    protected $cardExpiryYear;
    protected $cardCvc;
    protected $cardHolderName;
    protected $shopperIpAddress;
    protected $sessionId;

    /**
     * {@inheritdoc}
     *
     * @return Wfn_WorldPay_Api_PaymentService_ResponseInterface
     */
    public function send()
    {
        $result = parent::send();
        return (new Wfn_WorldPay_Api_PaymentService_Order_Response($result));
    }

    /**
     * {@inheritdoc}
     */
    public function asXml()
    {
        $cardType = (isset(static::$cardTypes[$this->cardType])) ? static::$cardTypes[$this->cardType] : '';

        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE paymentService PUBLIC "-//WorldPay//DTD WorldPay PaymentService v1//EN"
"http://dtd.worldpay.com/paymentService_v1.dtd">
<paymentService version="1.4" merchantCode="{$this->merchantCode}">
    <submit>
        <order orderCode="{$this->orderCode}">
            <description><![CDATA[{$this->description}]]></description>
            <amount value="{$this->amount}" currencyCode="{$this->currencyCode}" exponent="{$this->amountExponent}"/>
            <paymentDetails>
                <{$cardType}>
                    <cardNumber><![CDATA[{$this->cardNumber}]]></cardNumber>
                    <expiryDate>
                        <date month="{$this->cardExpiryMonth}" year="{$this->cardExpiryYear}"/>
                    </expiryDate>
                    <cardHolderName><![CDATA[{$this->cardHolderName}]]></cardHolderName>
                    <cvc><![CDATA[{$this->cardCvc}]]></cvc>
                </{$cardType}>
                <session shopperIPAddress="{$this->shopperIpAddress}" id="{$this->sessionId}"/>
            </paymentDetails>
        </order>
    </submit>
</paymentService>
XML;

        return $xml;
    }

    /**
     * Getters and setters.
     */

    public function setOrderCode($orderCode)
    {
        $this->orderCode = $orderCode;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount * 100;
        return $this;
    }

    public function setCardType($cardType)
    {
        $this->cardType = $cardType;
        return $this;
    }

    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    public function setCardExpiryMonth($cardExpiryMonth)
    {
        $this->cardExpiryMonth = $cardExpiryMonth;
        return $this;
    }

    public function setCardExpiryYear($cardExpiryYear)
    {
        $this->cardExpiryYear = $cardExpiryYear;
        return $this;
    }

    public function setCardCvc($cardCvc)
    {
        $this->cardCvc = $cardCvc;
        return $this;
    }

    public function setCardHolderName($cardHolderName)
    {
        $this->cardHolderName = $cardHolderName;
        return $this;
    }

    public function setShopperIpAddress($shopperIpAddress)
    {
        $this->shopperIpAddress = $shopperIpAddress;
        return $this;
    }

    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
        return $this;
    }
}
