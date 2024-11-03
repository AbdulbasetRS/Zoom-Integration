<?php

namespace Abdulbaset\ZoomIntegration;

use GuzzleHttp\Client;

class ZoomAuthenticator
{
    // The Zoom account ID used for authentication.
    private string $accountId;

    // The client ID assigned to the application by Zoom.
    private string $clientId;

    // The client secret assigned to the application by Zoom.
    private string $clientSecret;

    // An array to store authentication response data including the access token and scopes.
    private array $authenticator;

    /**
     * ZoomAuthenticator constructor.
     *
     * Initializes the ZoomAuthenticator with account credentials
     * and triggers the authentication process to obtain the access token.
     *
     * @param string $accountId The Zoom account ID.
     * @param string $clientId The Zoom application client ID.
     * @param string $clientSecret The Zoom application client secret.
     */
    public function __construct(string $accountId, string $clientId, string $clientSecret)
    {
        $this->accountId = $accountId;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->authenticate(); // Authenticate upon instantiation.
    }

    /**
     * Authenticates with Zoom's OAuth server to obtain an access token.
     *
     * This method sends a POST request to the Zoom OAuth token endpoint using
     * client credentials. The authentication response is stored in the
     * $authenticator property.
     *
     * @throws \GuzzleHttp\Exception\GuzzleException If there is an error with the HTTP request.
     */
    private function authenticate()
    {
        $client = new Client();

        // Send a POST request to Zoom's OAuth endpoint with account credentials
        $response = $client->post('https://zoom.us/oauth/token', [
            'form_params' => [
                'grant_type' => 'account_credentials',
                'account_id' => $this->accountId,
            ],
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode("{$this->clientId}:{$this->clientSecret}"),
            ],
        ]);

        // Decode JSON response and store it in the authenticator property
        $this->authenticator = json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Retrieves the access token from the authentication response.
     *
     * @return string The access token if available; otherwise, returns an empty string.
     */
    public function getAccessToken(): string
    {
        return $this->authenticator['access_token'] ?? '';
    }

    /**
     * Retrieves the scopes associated with the authenticated session as a string.
     *
     * @return string A space-separated string of scopes; returns an empty string if none are found.
     */
    public function getScopesInString(): string
    {
        return $this->authenticator['scope'] ?? '';
    }
}
