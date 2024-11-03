<?php

namespace Abdulbaset\ZoomIntegration\Interfaces;

interface ZoomClientInterface
{
    /**
     * Sends an HTTP request to the specified Zoom API endpoint.
     * 
     * This method should handle various HTTP methods (GET, POST, etc.) to interact 
     * with Zoom's API endpoints. It accepts parameters for the HTTP method, endpoint,
     * and additional request options, such as headers, query parameters, or body data.
     *
     * @param string $method The HTTP method to use for the request (e.g., 'GET', 'POST').
     * @param string $endpoint The API endpoint URL for the request.
     * @param array $options Optional parameters for the request (e.g., headers, query params).
     * 
     * @return array The response data from Zoom's API, formatted as an associative array.
     */
    public function request(string $method, string $endpoint, array $options = []): array;
}
