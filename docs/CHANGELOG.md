# Changelog

All important changes in this project are documented here, following the [Keep a Changelog](https://keepachangelog.com/en/1.0.0/) format.

## [1.1.0] - 2024-11-06

### Added

- Introduced `UserManagementInterface` and `MeetingManagementInterface` to abstract user and meeting management operations.
- Added `ZoomUserManagementService` and `ZoomMeetingManagementService` classes to handle user and meeting-related functionalities separately.
- Support for creating and updating users in Zoom through the integration.
- Added functionality to list users and meetings with pagination support.
- Implemented a method to retrieve all available user and meeting fields for reference, ensuring developers have a complete set of available attributes.
- Added `MeetingExamples.php` and `UserExamples.php` files containing comprehensive examples for user and meeting management operations, helping developers understand how to interact with the Zoom integration.

### Changed

- Refined the `ZoomIntegrationService` to use the newly added interfaces for better structure and maintainability.
- Updated class methods to follow consistent coding standards and ensure clearer functionality separation.

### Added Clarification

- **Individual Class Usage**:
  - If you're only interested in working with users, you can use the `ZoomUserManagementService` class, which focuses solely on user-related operations like creating, updating, listing, and deleting users.
  - Similarly, if you need to manage meetings only, you can use the `ZoomMeetingManagementService` class, which provides all the necessary methods for meeting creation, updates, retrieval, and management.
- **Using the Combined `ZoomIntegrationService`**:
  - For developers who want to manage both users and meetings in a single service, the `ZoomIntegrationService` is provided. This class aggregates all the methods from `ZoomUserManagementService` and `ZoomMeetingManagementService`, allowing you to manage both user and meeting-related functionalities through one interface.
  - The usage pattern for `ZoomIntegrationService` is consistent with the individual services. Whether you choose to use the services individually or the combined service, the method calls and setup process remain the same, ensuring a smooth development experience.

## [1.0.0] - 2024-11-03

### Added

- Initial release of `abdulbaset/zoom-integration`.
- Support for retrieving user information from Zoom.
- Meeting management functionality, allowing creation, updating, retrieval, and deletion of meetings.
- Scopes retrieval to display available permissions for integration.
- Comprehensive documentation and example usage for easy setup and integration with Laravel.
