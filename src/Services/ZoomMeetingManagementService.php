<?php

namespace Abdulbaset\ZoomIntegration\Services;

use Abdulbaset\ZoomIntegration\Interfaces\ZoomMeetingManagementInterface;
use Abdulbaset\ZoomIntegration\ZoomAuthenticator;
use Abdulbaset\ZoomIntegration\ZoomClient;

class ZoomMeetingManagementService implements ZoomMeetingManagementInterface
{
    /**
     * @var ZoomClient $client Instance of ZoomClient used for making API requests.
     */
    private ZoomClient $client;

    public function __construct(string $accountId, string $clientId, string $clientSecret)
    {
        // Authenticate with Zoom to get an access token
        $authenticator = new ZoomAuthenticator($accountId, $clientId, $clientSecret);
        $accessToken = $authenticator->getAccessToken();

        // Initialize ZoomClient with the access token
        $this->client = new ZoomClient($accessToken);
    }

    /**
     * Creates a new Zoom meeting with the specified details.
     *
     * This method will create a new meeting using the provided meeting data.
     * The meeting data should include parameters like topic, start time, duration, and more.
     *
     * @param array $meetingData An array containing the meeting details (topic, start time, duration, etc.).
     * @return array The response data containing the details of the newly created meeting.
     */
    public function createMeeting(array $meetingData): array
    {
        return $this->client->request('POST', 'https://api.zoom.us/v2/users/me/meetings', [
            'json' => $meetingData,
        ]);
    }

    /**
     * Retrieves the details of an existing Zoom meeting.
     *
     * This method will get the details of a meeting based on the provided meeting ID.
     *
     * @param int $meetingId The unique ID of the meeting to retrieve.
     * @return array The response data containing the meeting details.
     */
    public function getMeeting(int $meetingId): array
    {
        return $this->client->request('GET', "https://api.zoom.us/v2/meetings/{$meetingId}");
    }

    /**
     * Updates the details of an existing Zoom meeting.
     *
     * This method will update the meeting with the specified meeting ID using the provided data.
     * You can update parameters like the topic, time, and other meeting details.
     *
     * @param int $meetingId The unique ID of the meeting to update.
     * @param array $updatedData An array containing the updated meeting details.
     * @return array The response data confirming the meeting update.
     */
    public function updateMeeting(int $meetingId, array $updatedData): array
    {
        return $this->client->request('PATCH', "https://api.zoom.us/v2/meetings/{$meetingId}", [
            'json' => $updatedData,
        ]);
    }

    /**
     * Deletes an existing Zoom meeting.
     *
     * This method will delete the meeting with the specified meeting ID.
     *
     * @param int $meetingId The unique ID of the meeting to delete.
     * @return array The response data confirming the meeting deletion.
     */
    public function deleteMeeting(int $meetingId): array
    {
        return $this->client->request('DELETE', "https://api.zoom.us/v2/meetings/{$meetingId}");
    }

    /**
     * Lists all meetings associated with a user.
     *
     * This method will retrieve a list of meetings created by the authenticated user.
     * You can filter the meetings based on the user ID and get details like meeting topic,
     * start time, status, and more.
     *
     * @param string $userId The user ID of the Zoom account to retrieve meetings for.
     * @param int $pageSize The number of meetings to retrieve per page. Default is 30.
     * @param int $pageNumber The page number to retrieve. Default is 1.
     * @return array The response data containing a list of meetings.
     */
    public function listMeetings(string $userId, int $pageSize = 30, int $pageNumber = 1): array
    {
        return $this->client->request('GET', "https://api.zoom.us/v2/users/{$userId}/meetings", [
            'query' => [
                'page_size' => $pageSize,
                'page_number' => $pageNumber,
            ],
        ]);
    }

    /**
     * Adds a new registrant to a meeting.
     *
     * This method will add a new registrant to a Zoom meeting using the provided registration data.
     *
     * @param int $meetingId The unique ID of the meeting to add the registrant to.
     * @param array $registrantData An array containing registrant details such as email, first name, etc.
     * @return array The response data confirming the registrant's addition to the meeting.
     */
    public function addMeetingRegistrant(int $meetingId, array $registrantData): array
    {
        return $this->client->request('POST', "https://api.zoom.us/v2/meetings/{$meetingId}/registrants", [
            'json' => $registrantData,
        ]);
    }

    /**
     * Updates the status of an existing Zoom meeting.
     *
     * This method will change the status of a meeting (e.g., from scheduled to started).
     * It is useful for marking meetings as "completed" or "cancelled".
     *
     * @param int $meetingId The unique ID of the meeting to update.
     * @param string $status The new status to assign to the meeting (e.g., 'started', 'completed', 'cancelled').
     * @return array The response data confirming the meeting status update.
     */
    public function updateMeetingStatus(int $meetingId, string $status): array
    {
        return $this->client->request('PATCH', "https://api.zoom.us/v2/meetings/{$meetingId}", [
            'json' => ['status' => $status],
        ]);
    }

    /**
     * Retrieves the list of recordings for a specific meeting.
     *
     * This method will fetch the recording details of a specific meeting.
     *
     * @param int $meetingId The unique ID of the meeting to retrieve recordings for.
     * @return array The response data containing meeting recordings.
     */
    public function getMeetingRecordings(int $meetingId): array
    {
        return $this->client->request('GET', "https://api.zoom.us/v2/meetings/{$meetingId}/recordings");
    }
}
