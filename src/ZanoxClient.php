<?php
namespace vergelijkgroep\ZanoxApi;

use Httpful\Request;

class ZanoxClient {
    /**
     * @var string Zanox Connect ID
     */
    protected $connectId;

    /**
     * @var string Zanox Secret key
     */
    private $secretKey;

    /**
     * @var string Endpoint for Zanox API (without trailing slash)
     */
    protected $endpoint;

    /**
     * ZanoxClient constructor.
     * @param $connectId string Zanox Connect ID
     * @param $secretKey string Secret key
     */
    public function __construct($connectId, $secretKey) {
        $this->connectId = $connectId;
        $this->secretKey = $secretKey;
        $this->endpoint = 'https://api.zanox.com/xml/2011-03-01';
    }

    /**
     * Get all sales for a given date
     * @param \DateTime $date Date to retrieve sales for
     * @return array Sales for this date
     */
    public function getSalesForDate(\DateTime $date) {
        $saleXml = $this->makeRequest('/reports/sales/date/' . $date->format('Y-m-d'));

        $sales = [];

        foreach ($saleXml->saleItems->saleItem as $saleItem) {
            $sales[] = Sale::createFromXml($saleItem);
        }

        return $sales;
    }

    /**
     * Make an API request
     * @param $resource string URI to request (without the base endpoint)
     * @return array|object|string
     */
    protected function makeRequest($resource) {
        $signature = $this->signRequest('GET', $resource);
        $uri = $this->endpoint . $resource;

        $request = Request::get($uri)
            ->expectsXml()
            ->addHeader('Authorization', 'ZXWS ' . $this->connectId . ':' . $signature['signature'])
            ->addHeader('Date', $signature['timestamp'])
            ->addHeader('nonce', $signature['nonce']);

        $response = $request->send();

        return $response->body;
    }

    /**
     * Sign an API request
     * @param $method   string HTTP method (GET, POST, etc.)
     * @param $resource string Resource (URI) to sign
     * @return array Signature data. Contains signature, nonce and timestamp
     */
    private function signRequest($method, $resource) {
        $timestamp = gmdate('D, d M Y H:i:s T', time());
        $nonce = uniqid() . uniqid();

        $signString = mb_convert_encoding($method . $resource . $timestamp . $nonce, 'UTF-8');
        $signature = base64_encode(hash_hmac('sha1', $signString, $this->secretKey, true));

        return ['signature' => $signature, 'nonce' => $nonce, 'timestamp' => $timestamp];
    }
}