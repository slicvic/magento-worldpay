<?php
/**
 * Class Slicvic_WorldPay_Api_PaymentService_AbstractRequest
 */
abstract class Slicvic_WorldPay_Api_PaymentService_AbstractRequest implements Slicvic_WorldPay_Api_PaymentService_RequestInterface
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $merchantCode;

    /**
     * @var string
     */
    protected $password;

    /**
     * Constructor.
     *
     * @param string $url
     * @param string $merchantCode
     * @param string $password
     */
    public function __construct($url, $merchantCode, $password)
    {
        $this->url = $url;
        $this->merchantCode = $merchantCode;
        $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    public function send()
    {
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $this->merchantCode . ':' . $this->password);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->asXml());
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}
