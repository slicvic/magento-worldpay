<?php
/**
 * Class Slicvic_WorldPay_Api_PaymentService_Order_Response
 */
class Slicvic_WorldPay_Api_PaymentService_Order_Response implements Slicvic_WorldPay_Api_PaymentService_ResponseInterface
{
    /**
     * Whether or not the order was successful.
     *
     * @var bool
     */
    protected $isSuccess = false;

    /**
     * Success or error message.
     *
     * @var string
     */
    protected $message;

    /**
     * Raw XML response.
     *
     * @var string
     */
    protected $rawResponse;

    /**
     * Constructor.
     *
     * @param string $rawResponse
     */
    public function __construct($rawResponse)
    {
        $this->rawResponse = $rawResponse;
        $this->processRawResponse();
    }

    /**
     * {@inheritdoc}
     */
    public function isSuccess()
    {
        return $this->isSuccess;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Parse raw response for success status and message.
     *
     * @return null
     */
    protected function processRawResponse()
    {
        $xml = simplexml_load_string($this->rawResponse);

        if (isset($xml->reply->orderStatus->payment->lastEvent)) {
            $paymentStatus = (string) $xml->reply->orderStatus->payment->lastEvent;
            $this->message = $paymentStatus;
            $this->isSuccess = ('AUTHORISED' == strtoupper($paymentStatus));
            return;
        }

        if (isset($xml->reply->error['code'])) {
            $this->message = 'Code ' . (string) $xml->reply->error['code'];
            return;
        }

        if (isset($xml->head->title)) {
            $this->message = (string) $xml->head->title;
            return;
        }
    }
}
