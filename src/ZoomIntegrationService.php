<?php

namespace Abdulbaset\ZoomIntegration;

use Abdulbaset\ZoomIntegration\Helpers\ResponseHelper;
use Abdulbaset\ZoomIntegration\Interfaces\ZoomIntegrationServiceInterface;

class ZoomIntegrationService implements ZoomIntegrationServiceInterface
{
    /**
     * @var ZoomClient $client Instance of ZoomClient used for making API requests.
     */
    private ZoomClient $client;

    /**
     * A string representing the scopes available for the Zoom integration,
     * formatted as a space-separated list.
     *
     * This property holds the scopes as a single string, which can be parsed
     * into an array for easier access and manipulation.
     *
     * @var string
     */
    private $scopesInString;

    /**
     * Constructor to initialize the ZoomIntegrationService with authentication credentials.
     *
     * This constructor uses the provided account ID, client ID, and client secret to
     * authenticate with Zoom and obtain an access token. It then initializes the
     * ZoomClient with the access token for making authenticated API requests.
     *
     * @param string $accountId The Zoom account ID.
     * @param string $clientId The Zoom client ID.
     * @param string $clientSecret The Zoom client secret.
     */
    public function __construct(string $accountId, string $clientId, string $clientSecret)
    {
        // Authenticate with Zoom to get an access token
        $authenticator = new ZoomAuthenticator($accountId, $clientId, $clientSecret);
        $accessToken = $authenticator->getAccessToken();
        $this->scopesInString = $authenticator->getScopesInString();

        // Initialize ZoomClient with the access token
        $this->client = new ZoomClient($accessToken);
    }

    /**
     * Retrieves information about the authenticated Zoom user.
     *
     * @return array Response containing user information.
     */
    public function getUser(): array
    {
        return $this->client->request('GET', 'https://api.zoom.us/v2/users/me');
    }

    /**
     * Creates a new Zoom meeting with the specified data.
     *
     * @param array $meetingData An array of meeting details such as topic, start time, and settings.
     * @return array Response containing details of the created meeting.
     */
    public function createMeeting(array $meetingData): array
    {
        return $this->client->request('POST', 'https://api.zoom.us/v2/users/me/meetings', [
            'json' => $meetingData,
        ]);
    }

    /**
     * Updates an existing Zoom meeting with the provided data.
     *
     * @param int $meetingId The ID of the meeting to update.
     * @param array $meetingData An array of updated meeting details.
     * @return array Response confirming the update operation.
     */
    public function updateMeeting(int $meetingId, array $meetingData): array
    {
        return $this->client->request('PATCH', "https://api.zoom.us/v2/meetings/{$meetingId}", [
            'json' => $meetingData,
        ]);
    }

    /**
     * Deletes a specific Zoom meeting.
     *
     * @param int $meetingId The ID of the meeting to delete.
     * @return array Response confirming the deletion operation.
     */
    public function deleteMeeting(int $meetingId): array
    {
        return $this->client->request('DELETE', "https://api.zoom.us/v2/meetings/{$meetingId}");
    }

    /**
     * Retrieves information about a specific Zoom meeting.
     *
     * @param int $meetingId The ID of the meeting to retrieve.
     * @return array Response containing meeting details.
     */
    public function getMeeting(int $meetingId): array
    {
        return $this->client->request('GET', "https://api.zoom.us/v2/meetings/{$meetingId}");
    }

    /**
     * Lists all Zoom meetings for the authenticated user, with pagination support.
     *
     * @param int $pageSize The number of meetings to retrieve per page (default is 30).
     * @param int $pageNumber The page number to retrieve (default is 1).
     * @return array Response containing a list of meetings.
     */
    public function listMeetings(int $pageSize = 30, int $pageNumber = 1): array
    {
        return $this->client->request('GET', 'https://api.zoom.us/v2/users/me/meetings', [
            'query' => [
                'page_size' => $pageSize,
                'page_number' => $pageNumber,
            ],
        ]);
    }

    /**
     * Retrieves the scopes associated with the Zoom integration.
     *
     * This method splits the scopes stored in a space-separated string
     * into an array and returns it wrapped in a standardized response format.
     *
     * @return array An array containing the scopes along with a status message.
     */
    public function getScopes(): array
    {
        return ResponseHelper::response(200, null, ['scopes' => explode(' ', $this->scopesInString)]);
    }
}
