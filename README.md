![Thumbnail](docs/thumbnail.png)

# Documentation

## Zoom Integration

This PHP package provides a comprehensive integration for Zoom API functionalities. It allows developers to easily manage users and meetings through a simple interface. The package is specifically designed for Laravel applications, but can be integrated into any PHP application.

## Features

- User Management: Retrieve and manage Zoom users.
- Meeting Management: Create, update, retrieve, and delete Zoom meetings.
- Scopes Retrieval: Get available scopes for Zoom integration.
- Easy Integration: Quick setup and integration into Laravel projects.

## Installation

Use [Composer](https://getcomposer.org/) to install the package:

You can install this package via Composer:

```bash
composer require abdulbaset/zoom-integration
```

To update the `abdulbaset/zoom-integration` package in your Laravel project, you can use Composer's update command, Here's how you can do it:

```bash
composer update abdulbaset/zoom-integration
```

After running the update command in your Laravel project directory, and Composer will check for updates to the `abdulbaset/zoom-integration` package and its dependencies. If a newer version is available, Composer will download and install it, updating your project.

## Usage

Here is an example of how to use the package to create and manage meetings.

### Initialization

```php
use Abdulbaset\ZoomIntegration\ZoomIntegrationService;

// Initialize the ZoomIntegrationService
$zoomService = new ZoomIntegrationService($accountId, $clientId, $clientSecret);
```

### User Management

```php
// Get User Information
$user = $zoomService->getUser();

// Update User
$updateData = [
    'first_name' => 'John',
    'last_name' => 'Doe',
    'email' => 'john.doe@example.com',
];
$updatedUser = $zoomService->updateUser($userId, $updateData);

// Create User
$userData = [
    'first_name' => 'Jane',
    'last_name' => 'Doe',
    'email' => 'jane.doe@example.com',
    'type' => 1, // Pro user
];
$createdUser = $zoomService->createUser($userData);

// List Users
$listUsers = $zoomService->listUsers();

// Delete User
$deletedUser = $zoomService->deleteUser($userId);
```

### Meeting Management

```php
// Create a Meeting
$meetingData = [
    'topic' => 'Test Meeting',
    'type' => 2,
    'start_time' => '2024-11-03T10:00:00Z',
    'duration' => 30,
    'timezone' => 'UTC',
    'agenda' => 'Discuss project updates',
];
$createdMeeting = $zoomService->createMeeting($meetingData);

// Get Meeting Details
$meetingId = $createdMeeting['response']['id'] ?? null;
if ($meetingId) {
    $meetingDetails = $zoomService->getMeeting($meetingId);

    // Update Meeting
    $updateData = [
        'topic' => 'Updated Meeting Topic',
        'agenda' => 'Updated agenda for the meeting',
    ];
    $updatedMeeting = $zoomService->updateMeeting($meetingId, $updateData);

    // Delete Meeting
    $deletedMeeting = $zoomService->deleteMeeting($meetingId);
}

// List all Meetings
$listMeetings = $zoomService->listMeetings();
```

### Scopes Retrieval

```php
// Get Scopes
$scopes = $zoomService->getScopes();
```

## API Documentation Sources

- [Zoom Developers - Zoom API Documentation](https://developers.zoom.us/docs/api/meetings/#tag/archiving/GET/past_meetings/{meetingUUID}/archive_files)
- [Harvard University - Zoom Integration Guide](https://portal.stage.apis.huit.harvard.edu/docs/ccs-zoom-api/1/overview)

## Video Tutorials

For a step-by-step guide on how to install and use this package, check out our YouTube playlist:

[Zoom Integration Package Tutorials](https://youtube.com/playlist?list=PLcEe-K0XsWNmR5U8X_u4LnMJ1xb4_xo9E&si=s_pvADiElFHB_NtS)

This playlist provides in-depth tutorials on setting up and managing the Zoom API features using this package.

## Notes

You can find all the fields that you can add and their meanings through the following links:

- [Fields in English](docs/Meeting-Fields/en.md)
- [Fields in Arabic](docs/Meeting-Fields/ar.md)

## Author

The package was created by Abdulbaset R. Sayed <AbdulbasetRedaSayedHF@Gmail.com>

## Contributing

Contributions are welcome! If you encounter any issues or have suggestions for improvements, feel free to open an issue or submit a pull request on GitHub.

## Change Log

For a detailed list of changes and updates in each version, see the [Change Log](docs/CHANGELOG.md).

## License

This Package is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
