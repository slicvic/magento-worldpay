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
    protected static $ccTypes = [
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
    protected $orderNumber;
    protected $orderDescription = '&amp;nbsp;';
    protected $amount;
    protected $amountExponent = 2;
    protected $currencyCode = 'US';
    protected $ccType;
    protected $ccNumber;
    protected $ccExpiryMonth;
    protected $ccExpiryYear;
    protected $ccCvc;
    protected $customerEmail;
    protected $billingName;
    protected $billingAddress1;
    protected $billingAddress2 = '';
    protected $billingCity;
    protected $billingState;
    protected $billingPostalCode;
    protected $billingCountryCode = 'US';
    protected $billingTelephone;
    protected $customerIpAddress;
    protected $sessionId;
    protected $browserAcceptHeader;
    protected $browserUserAgentHeader;

    /**
     * {@inheritdoc}
     *
     * @throws Wfn_ConcardisPay_Api_Exception
     */
    public function send()
    {
        if (!isset(static::$ccTypes[$this->ccType])) {
            throw new Wfn_WorldPay_Api_Exception("Error: Invalid credit card type {$this->ccType}");
        }
        return parent::send();
    }

    /**
     * {@inheritdoc}
     */
    public function toXmlString()
    {
        $ccTypes = static::$ccTypes;

        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE paymentService PUBLIC "-//WorldPay//DTD WorldPay PaymentService v1//EN"
"http://dtd.worldpay.com/paymentService_v1.dtd">
<paymentService version="1.4" merchantCode="{$this->merchantCode}">
    <submit>
        <order orderCode="{$this->orderNumber}">
            <description>><![CDATA[{$this->orderDescription}]]></description>
            <amount currencyCode="{$this->currencyCode}" exponent="{$this->amountExponent}" value="{$this->amount}"/>
            <paymentDetails>
                <{$ccTypes[$this->ccType]}>
                    <cardNumber>{$this->ccNumber}</cardNumber>
                    <expiryDate><date month="{$this->ccExpiryMonth}" year="{$this->ccExpiryYear}"/></expiryDate>
                    <cardHolderName><![CDATA[{$this->billingName}]]></cardHolderName>
                    <cvc>{$this->ccCvc}</cvc>
                    <cardAddress>
                        <address>
                            <address1><![CDATA[{$this->billingAddress1}]]></address1>
                            <address2><![CDATA[{$this->billingAddress2}]]></address2>
                            <address3></address3>
                            <postalCode><![CDATA[{$this->billingPostalCode}]]></postalCode>
                            <city><![CDATA[{$this->billingCity}]]></city>
                            <state><![CDATA[{$this->billingState}]]></state>
                            <countryCode><![CDATA[{$this->billingCountryCode}]]></countryCode>
                            <telephoneNumber><![CDATA[{$this->billingTelephone}]]></telephoneNumber>
                        </address>
                    </cardAddress>
                </{$ccTypes[$this->ccType]}>
                <session shopperIPAddress="{$this->customerIpAddress}" id="{$this->sessionId}"/>
            </paymentDetails>
            <shopper>
                <shopperEmailAddress><![CDATA[{$this->customerEmail}]]></shopperEmailAddress>
                <browser>
                    <acceptHeader><![CDATA[{$this->browserAcceptHeader}]]></acceptHeader>
                    <userAgentHeader><![CDATA[{$this->browserUserAgentHeader}]]></userAgentHeader>
                </browser>
            </shopper>
            <statementNarrative></statementNarrative>
        </order>
    </submit>
</paymentService>
XML;

        return $xml;
    }

    /**
     * Getters and setters.
     */

    public function setOrderNumber($orderNumber)
    {
        $this->orderNumber = $orderNumber;
        return $this;
    }

    public function setOrderDescription($orderDescription)
    {
        $this->orderDescription = $orderDescription;
        return $this;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function setAmountExponent($amountExponent)
    {
        $this->amountExponent = $amountExponent;
        return $this;
    }

    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
        return $this;
    }

    public function setCcType($ccType)
    {
        $this->ccType = $ccType;
        return $this;
    }

    public function setCcNumber($ccNumber)
    {
        $this->ccNumber = $ccNumber;
        return $this;
    }

    public function setCcExpiryMonth($ccExpiryMonth)
    {
        $this->ccExpiryMonth = $ccExpiryMonth;
        return $this;
    }

    public function setCcExpiryYear($ccExpiryYear)
    {
        $this->ccExpiryYear = $ccExpiryYear;
        return $this;
    }

    public function setCcCvc($ccCvc)
    {
        $this->ccCvc = $ccCvc;
        return $this;
    }

    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;
        return $this;
    }

    public function setBillingName($billingName)
    {
        $this->billingName = $billingName;
        return $this;
    }

    public function setBillingAddress1($billingAddress1)
    {
        $this->billingAddress1 = $billingAddress1;
        return $this;
    }

    public function setBillingAddress2($billingAddress2)
    {
        $this->billingAddress2 = $billingAddress2;
        return $this;
    }

    public function setBillingCity($billingCity)
    {
        $this->billingCity = $billingCity;
        return $this;
    }

    public function setBillingState($billingState)
    {
        $this->billingState = $billingState;
        return $this;
    }

    public function setBillingPostalCode($billingPostalCode)
    {
        $this->billingPostalCode = $billingPostalCode;
        return $this;
    }

    public function setBillingCountryCode($billingCountryCode)
    {
        $this->billingCountryCode = $billingCountryCode;
        return $this;
    }

    public function setBillingTelephone($billingTelephone)
    {
        $this->billingTelephone = $billingTelephone;
        return $this;
    }

    public function setCustomerIpAddress($customerIpAddress)
    {
        $this->customerIpAddress = $customerIpAddress;
        return $this;
    }

    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
        return $this;
    }

    public function setBrowserAcceptHeader($browserAcceptHeader)
    {
        $this->browserAcceptHeader = $browserAcceptHeader;
        return $this;
    }

    public function setBrowserUserAgentHeader($browserUserAgentHeader)
    {
        $this->browserUserAgentHeader = $browserUserAgentHeader;
        return $this;
    }
}