<?php
namespace whitelabeled\ZanoxApi;

use DateTime;
use Httpful\Request;
use whitelabeled\ZanoxApi\Exceptions\ZanoxApiException;

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
    protected $endpoint = 'https://api.zanox.com/xml/2011-03-01';

    /**
     * @var int Items per page
     */
    protected $itemsPerPage = 50;

    /**
     * ZanoxClient constructor.
     * @param $connectId string Zanox Connect ID
     * @param $secretKey string Secret key
     */
    public function __construct($connectId, $secretKey) {
        $this->connectId = $connectId;
        $this->secretKey = $secretKey;
    }

    /**
     * Get all sales for a given date
     * @param DateTime $date Date to retrieve sales for
     * @param int      $page Start page (defaults to 0)
     * @return array Sales for this date
     */
    public function getSalesForDate(DateTime $date, $page = 0) {
        $saleUri = '/reports/sales/date/' . $date->format('Y-m-d');

        $saleXml = $this->makeRequest($saleUri, '?items=' . $this->itemsPerPage . '&page=' . $page);

        $sales = [];

        if (isset($saleXml->saleItems)) {
            foreach ($saleXml->saleItems->saleItem as $saleItem) {
                $sales[] = Sale::createFromXml($saleItem);
            }
        }

        // Check whether more iterations are needed:
        $totalItems = (int)$saleXml->total;
        $currentPageTotal = (int)$saleXml->items + $this->itemsPerPage * $page;

        // Retrieve more items when
        if ($totalItems > $currentPageTotal) {
            $sales = array_merge($sales, $this->getSalesForDate($date, $page + 1));
        }

        return $sales;
    }

    /**
     * Make an API request
     * @param $resource string URI to request (without the base endpoint)
     * @param $query    string Query parameters
     * @return array|object|string
     * @throws ZanoxApiException
     */
    protected function makeRequest($resource, $query = "") {
        $signature = $this->signRequest('GET', $resource);
        $uri = $this->endpoint . $resource;

        $request = Request::get($uri . $query)
            ->expectsXml()
            ->addHeader('Authorization', 'ZXWS ' . $this->connectId . ':' . $signature['signature'])
            ->addHeader('Date', $signature['timestamp'])
            ->addHeader('nonce', $signature['nonce']);

        $response = $request->send();

        // Check for errors
        if ($response->hasErrors()) {
            $message = 'Unknown error';

            if (isset($response->body->message)) {
                $message = (string)$response->body->message;
            }

            if (isset($response->body->reason)) {
                $message .= ' Reason: ' . (string)$response->body->reason;
            }

            throw new ZanoxApiException($message);
        }

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