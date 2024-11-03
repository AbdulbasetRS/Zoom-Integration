<?php

namespace Abdulbaset\ZoomIntegration\Interfaces;

interface ZoomIntegrationServiceInterface
{
    /**
     * Retrieves the details of the authenticated user.
     *
     * This method should interact with the Zoom API to get information about
     * the currently authenticated user, such as name, email, and user type.
     *
     * @return array The response data containing user details.
     */
    public function getUser(): array;

    /**
     * Creates a new Zoom meeting.
     *
     * This method takes meeting data (e.g., topic, start time, settings) and
     * creates a new meeting on the Zoom platform by sending a request to Zoom's API.
     *
     * @param array $meetingData An array containing details of the meeting to be created.
     * @return array The response data from Zoom API containing meeting details.
     */
    public function createMeeting(array $meetingData): array;

    /**
     * Updates an existing Zoom meeting.
     *
     * This method updates the specified meeting with new data, such as updating
     * the meeting topic, time, or other settings.
     *
     * @param int $meetingId The ID of the meeting to be updated.
     * @param array $meetingData An array of updated meeting details.
     * @return array The response data confirming the update.
     */
    public function updateMeeting(int $meetingId, array $meetingData): array;

    /**
     * Deletes a specified Zoom meeting.
     *
     * This method deletes an existing meeting by its ID, removing it from the user's Zoom account.
     *
     * @param int $meetingId The ID of the meeting to be deleted.
     * @return array The response data confirming the deletion.
     */
    public function deleteMeeting(int $meetingId): array;

    /**
     * Retrieves details of a specific Zoom meeting.
     *
     * This method fetches details of a particular meeting, such as participants,
     * meeting settings, and join information, using the meeting ID.
     *
     * @param int $meetingId The ID of the meeting to retrieve.
     * @return array The response data containing meeting details.
     */
    public function getMeeting(int $meetingId): array;

    /**
     * Lists the Zoom meetings for the authenticated user.
     *
     * This method fetches a paginated list of meetings from Zoom for the authenticated user,
     * allowing specification of page size and page number for navigation.
     *
     * @param int $pageSize The number of meetings per page (default is 30).
     * @param int $pageNumber The page number to retrieve (default is 1).
     * @return array The response data containing a list of meetings.
     */
    public function listMeetings(int $pageSize = 30, int $pageNumber = 1): array;

    /**
     * Retrieves the scopes associated with the Zoom integration.
     *
     * This method returns an array of scopes that define the permissions
     * granted to the application for accessing Zoom's API functionalities.
     * It is useful for understanding the access level the application has
     * for making requests to Zoom services.
     *
     * @return array An array of scopes associated with the integration.
     */
    public function getScopes(): array;
}
