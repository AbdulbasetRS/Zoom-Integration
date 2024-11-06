<?php

namespace Abdulbaset\ZoomIntegration\Interfaces;

interface ZoomMeetingManagementInterface
{
    /**
     * Creates a new Zoom meeting.
     *
     * This method interacts with the Zoom API to create a new meeting
     * based on the provided meeting data (such as topic, start time, and duration).
     *
     * @param array $meetingData The data required to create the meeting.
     * @return array The response data containing the created meeting details.
     */
    public function createMeeting(array $meetingData): array;

    /**
     * Updates a Zoom meeting with the provided meeting data.
     *
     * This method allows updating the meeting details such as topic, start time,
     * or duration, interacting with the Zoom API.
     *
     * @param int $meetingId The ID of the meeting to update.
     * @param array $updatedData The data to update the meeting.
     * @return array The response data containing the updated meeting details.
     */
    public function updateMeeting(int $meetingId, array $updatedData): array;

    /**
     * Retrieves information of a specific meeting by ID.
     *
     * This method fetches meeting details by the unique meeting ID from the Zoom API.
     *
     * @param int $meetingId The ID of the meeting to retrieve details for.
     * @return array The response data containing the meeting details.
     */
    public function getMeeting(int $meetingId): array;

    /**
     * Deletes a specific meeting by ID.
     *
     * This method deletes a meeting using its unique meeting ID through the Zoom API.
     * Once deleted, the meeting will no longer be accessible.
     *
     * @param int $meetingId The ID of the meeting to delete.
     * @return array The response data confirming the meeting deletion.
     */
    public function deleteMeeting(int $meetingId): array;

    /**
     * Retrieves a list of meetings for a specific user.
     *
     * This method interacts with the Zoom API to retrieve a list of meetings for the given user ID.
     * You can specify the user ID to get meetings for a specific user.
     * The response will include details such as meeting ID, topic, status, etc.
     *
     * @param string $userId The unique ID of the user whose meetings are to be retrieved.
     * @param int $pageSize The number of meetings to retrieve per page.
     * @param int $pageNumber The page number to retrieve.
     *
     * @return array The response data containing a list of meetings.
     */
    public function listMeetings(string $userId, int $pageSize = 30, int $pageNumber = 1): array;

    /**
     * Adds a registrant to a meeting.
     *
     * This method adds a new registrant to a meeting by providing the registrant's data
     * such as name, email, and other necessary information.
     *
     * @param int $meetingId The ID of the meeting to register the user for.
     * @param array $registrantData The data of the registrant to add.
     * @return array The response data confirming the addition of the registrant.
     */
    public function addMeetingRegistrant(int $meetingId, array $registrantData): array;

    /**
     * Updates the status of a specific meeting.
     *
     * This method changes the status of a meeting, for example, starting or stopping it.
     *
     * @param int $meetingId The ID of the meeting to update.
     * @param string $status The new status of the meeting (e.g., 'started', 'ended').
     * @return array The response data confirming the status update.
     */
    public function updateMeetingStatus(int $meetingId, string $status): array;

    /**
     * Retrieves the recordings of a specific meeting.
     *
     * This method retrieves the recordings for a meeting using its meeting ID.
     *
     * @param int $meetingId The ID of the meeting to fetch recordings for.
     * @return array The response data containing the meeting recordings.
     */
    public function getMeetingRecordings(int $meetingId): array;
}
