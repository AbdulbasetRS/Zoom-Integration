<?php

require __DIR__ . '/../vendor/autoload.php'; // Autoload Composer dependencies

use Abdulbaset\ZoomIntegration\ZoomIntegrationService;

$config = include __DIR__ . '/../config/config.php';

$account_id = $config['accountId'];
$client_id = $config['clientId'];
$client_secret = $config['clientSecret'];

// Initialize ZoomIntegrationService
$zoomService = new ZoomIntegrationService($account_id, $client_id, $client_secret);

// Example 1: Create User
$userData = [
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'john.doe@example.com',
    'type' => 1, // Basic user
];

$createUserResponse = $zoomService->createUser($userData);
echo "Create User Response: " . json_encode($createUserResponse) . PHP_EOL;

// Example 2: Get User Information
$userId = 'me'; // Use 'me' to get the authenticated user's info
$getUserResponse = $zoomService->getUser($userId);
echo "Get User Response: " . json_encode($getUserResponse) . PHP_EOL;

// Example 3: Update User
$updatedUserData = [
    'first_name' => 'Jane',
    'last_name' => 'Smith',
];
$updateUserResponse = $zoomService->updateUser($userId, $updatedUserData);
echo "Update User Response: " . json_encode($updateUserResponse) . PHP_EOL;

// Example 4: Delete User
$deleteUserResponse = $zoomService->deleteUser($userId);
echo "Delete User Response: " . json_encode($deleteUserResponse) . PHP_EOL;

// Example 5: List Users
$listUsersResponse = $zoomService->listUsers('active'); // Optionally change status
echo "List Users Response: " . json_encode($listUsersResponse) . PHP_EOL;

// Example 6: Change User Status
$newStatus = 'inactive';
$changeStatusResponse = $zoomService->changeUserStatus($userId, $newStatus);
echo "Change User Status Response: " . json_encode($changeStatusResponse) . PHP_EOL;

// Example 7: Update User Password
$newPassword = 'newSecurePassword123';
$updatePasswordResponse = $zoomService->updateUserPassword($userId, $newPassword);
echo "Update User Password Response: " . json_encode($updatePasswordResponse) . PHP_EOL;

// Example 8: Check if User Email Exists
$emailCheckResponse = $zoomService->checkUserEmailExists('john.doe@example.com');
echo "Check Email Exists Response: " . json_encode($emailCheckResponse) . PHP_EOL;
