<?php

require __DIR__ . '/../vendor/autoload.php';

use Abdulbaset\ZoomIntegration\ZoomIntegrationService;

$config = include __DIR__ . '/../config/config.php';
$account_id = $config['accountId'];
$client_id = $config['clientId'];
$client_secret = $config['clientSecret'];

$zoomService = new ZoomIntegrationService($account_id, $client_id, $client_secret);

// $user = $zoomService->getUser();
// echo json_encode($user, JSON_PRETTY_PRINT) . "\n";

// $meetingData = [
//     'topic' => 'Test Meeting',
//     'type' => 2,
//     'start_time' => '2024-11-03T10:00:00Z',
//     'duration' => 30,
//     'timezone' => 'UTC',
//     'agenda' => 'Discuss project updates',
// ];

// $createdMeeting = $zoomService->createMeeting($meetingData);
// echo json_encode($createdMeeting, JSON_PRETTY_PRINT) . "\n";

// $meetingId = $createdMeeting['response']['id'] ?? null;
// if ($meetingId) {
//     $meetingDetails = $zoomService->getMeeting($meetingId);
//     json_encode($meetingDetails, JSON_PRETTY_PRINT) . "\n";

//     $updateData = [
//         'topic' => 'Updated Meeting Topic',
//         'agenda' => 'Updated agenda for the meeting',
//     ];
//     $updatedMeeting = $zoomService->updateMeeting($meetingId, $updateData);
//     json_encode($updatedMeeting, JSON_PRETTY_PRINT) . "\n";

//     $deletedMeeting = $zoomService->deleteMeeting($meetingId);
//     json_encode($deletedMeeting, JSON_PRETTY_PRINT) . "\n";
// }

// $listMeetings = $zoomService->listMeetings();
// echo json_encode($listMeetings, JSON_PRETTY_PRINT) . "\n";

// $scopes = $zoomService->getScopes();
// echo json_encode($scopes, JSON_PRETTY_PRINT) . "\n";
