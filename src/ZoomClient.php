<?php

namespace Abdulbaset\ZoomIntegration;

use Abdulbaset\ZoomIntegration\Helpers\ResponseHelper;
use Abdulbaset\ZoomIntegration\Interfaces\ZoomClientInterface;
use GuzzleHttp\Client;

class ZoomClient implements ZoomClientInterface
{
    /**
     * @var string $accessToken The access token used for authenticating Zoom API requests.
     */
    private string $accessToken;

    /**
     * @var Client $httpClient The Guzzle HTTP client used for making requests.
     */
    private Client $httpClient;

    /**
     * Constructor to initialize the ZoomClient with an access token.
     *
     * @param string $accessToken The access token required for authenticated API requests.
     */
    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
        $this->httpClient = new Client();
    }

    /**
     * Sends an HTTP request to the specified Zoom API endpoint.
     *
     * This method prepares and executes an API request using the provided HTTP method, 
     * endpoint, and options. It handles both successful and failed requests, formatting
     * responses as needed using the ResponseHelper.
     *
     * @param string $method The HTTP method to use (e.g., 'GET', 'POST').
     * @param string $endpoint The URL endpoint for the API request.
     * @param array $options Optional parameters to include in the request, such as query or form data.
     * @return array An associative array with the response status, message, and data or error details.
     */
    public function request(string $method, string $endpoint, array $options = []): array
    {
        try {
            // Set authorization and content headers for the request
            $options['headers']['Authorization'] = 'Bearer ' . $this->accessToken;
            $options['headers']['Content-Type'] = 'application/json';

            // Make the HTTP request using the specified method, endpoint, and options
            $response = $this->httpClient->request($method, $endpoint, $options);
            $data = json_decode($response->getBody()->getContents(), true);

            // Return a successful response using ResponseHelper
            return ResponseHelper::response(200, 'Request successful', $data);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Handle client errors (4xx) by extracting error details from the response
            $data = json_decode($e->getResponse()->getBody()->getContents(), true);
            return ResponseHelper::response($e->getResponse()->getStatusCode(), $data['message'] ?? 'Request failed', $data);
        }
    }
}
