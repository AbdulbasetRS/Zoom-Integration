<?php

require __DIR__ . '/../vendor/autoload.php'; // Autoload Composer dependencies

use Abdulbaset\ZoomIntegration\ZoomIntegrationService;

$config = include __DIR__ . '/../config/config.php';

$account_id = $config['accountId'];
$client_id = $config['clientId'];
$client_secret = $config['clientSecret'];

// Initialize ZoomIntegrationService
$zoomService = new ZoomIntegrationService($account_id, $client_id, $client_secret);

// Example 1: Create Meeting
$meetingData = [
    'topic' => 'Team Sync',
    'type' => 2,  // Scheduled meeting
    'start_time' => '2024-11-07T15:00:00Z',
    'duration' => 30,  // in minutes
    'timezone' => 'Asia/Cairo',
    'agenda' => 'Discuss project updates',
];

$createMeetingResponse = $zoomService->createMeeting($meetingData);
echo "Create Meeting Response: " . json_encode($createMeetingResponse) . PHP_EOL;

// Example 2: Get Meeting Information
$meetingId = 123456789;  // Use a valid meeting ID
$getMeetingResponse = $zoomService->getMeeting($meetingId);
echo "Get Meeting Response: " . json_encode($getMeetingResponse) . PHP_EOL;

// Example 3: Update Meeting
$updatedMeetingData = [
    'topic' => 'Updated Team Sync',
    'agenda' => 'Discuss latest project milestones',
];
$updateMeetingResponse = $zoomService->updateMeeting($meetingId, $updatedMeetingData);
echo "Update Meeting Response: " . json_encode($updateMeetingResponse) . PHP_EOL;

// Example 4: Delete Meeting
$deleteMeetingResponse = $zoomService->deleteMeeting($meetingId);
echo "Delete Meeting Response: " . json_encode($deleteMeetingResponse) . PHP_EOL;

// Example 5: List Meetings
$userId = 'me'; // Use 'me' to list meetings for the authenticated user
$listMeetingsResponse = $zoomService->listMeetings($userId);
echo "List Meetings Response: " . json_encode($listMeetingsResponse) . PHP_EOL;

// Example 6: Add Meeting Registrant
$registrantData = [
    'email' => 'guest@example.com',
    'first_name' => 'Guest',
    'last_name' => 'User',
];
$addRegistrantResponse = $zoomService->addMeetingRegistrant($meetingId, $registrantData);
echo "Add Registrant Response: " . json_encode($addRegistrantResponse) . PHP_EOL;

// Example 7: Update Meeting Status
$newMeetingStatus = 'inactive';
$updateMeetingStatusResponse = $zoomService->updateMeetingStatus($meetingId, $newMeetingStatus);
echo "Update Meeting Status Response: " . json_encode($updateMeetingStatusResponse) . PHP_EOL;

// Example 8: Get Meeting Recordings
$getMeetingRecordingsResponse = $zoomService->getMeetingRecordings($meetingId);
echo "Get Meeting Recordings Response: " . json_encode($getMeetingRecordingsResponse) . PHP_EOL;

?>
