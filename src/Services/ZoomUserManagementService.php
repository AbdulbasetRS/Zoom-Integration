<?php

namespace Abdulbaset\ZoomIntegration\Services;

use Abdulbaset\ZoomIntegration\Helpers\ResponseHelper;
use Abdulbaset\ZoomIntegration\Interfaces\ZoomUserManagementInterface;
use Abdulbaset\ZoomIntegration\ZoomAuthenticator;
use Abdulbaset\ZoomIntegration\ZoomClient;

class ZoomUserManagementService implements ZoomUserManagementInterface
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
     * Creates a new user with the specified details.
     *
     * This method will make a request to the Zoom API to create a new user with the given data.
     * The data should include details like email, first name, last name, etc.
     *
     * @param array $userData An array containing the user's details such as email, first name, last name, etc.
     * @return array The response data containing the newly created user's details.
     */
    public function createUser(array $userData): array
    {
        return $this->client->request('POST', 'https://api.zoom.us/v2/users', [
            'json' => $userData,
        ]);
    }

    /**
     * Updates the details of an existing user.
     *
     * This method will update the user details for the specified user ID.
     * You need to provide the user ID and the data to be updated (e.g., email, first name, etc.).
     *
     * @param string $userId The unique ID of the user to update.
     * @param array $updatedData An array containing the updated user details.
     * @return array The response data confirming the user update.
     */
    public function updateUser(string $userId, array $updatedData): array
    {
        return $this->client->request('PATCH', "https://api.zoom.us/v2/users/{$userId}", [
            'json' => $updatedData,
        ]);
    }

    /**
     * Retrieves the details of the authenticated user.
     *
     * This method should interact with the Zoom API to get information about
     * the currently authenticated user, such as name, email, and user type.
     *
     * @param string $userId The unique ID of the user to retrieve. Default is 'me' for the authenticated user.
     *
     * @return array The response data containing user details.
     */
    public function getUser(string $userId = 'me'): array
    {
        return $this->client->request('GET', "https://api.zoom.us/v2/users/{$userId}");
    }

    /**
     * Deletes an existing user by their ID.
     *
     * This method will delete the user with the specified user ID from Zoom.
     *
     * @param string $userId The unique ID of the user to delete.
     * @return array The response data confirming the user deletion.
     */
    public function deleteUser(string $userId): array
    {
        return $this->client->request('DELETE', "https://api.zoom.us/v2/users/{$userId}");
    }

    /**
     * Lists all users based on the given status (active or inactive).
     *
     * This method interacts with the Zoom API to retrieve a list of users.
     * The status can be either 'active' or 'inactive'.
     *
     * @param string $status The status of users to retrieve ('active' or 'inactive'). Default is 'active'.
     * @param int $pageSize The number of users to retrieve per page. Default is 30.
     * @param int $pageNumber The page number to retrieve. Default is 1.
     * @return array The response data containing a list of users.
     */
    public function listUsers(string $status = 'active', int $pageSize = 30, int $pageNumber = 1): array
    {
        return $this->client->request('GET', 'https://api.zoom.us/v2/users', [
            'query' => [
                'status' => $status,
                'page_size' => $pageSize,
                'page_number' => $pageNumber,
            ],
        ]);
    }

    /**
     * Changes the status of a user (active, inactive, etc.).
     *
     * This method will change the status of the specified user.
     * The status can be set to 'active', 'inactive', or other valid Zoom statuses.
     *
     * @param string $userId The unique ID of the user to update.
     * @param string $status The new status to assign to the user.
     * @return array The response data confirming the user status update.
     */
    public function changeUserStatus(string $userId, string $status): array
    {
        return $this->client->request('PUT', "https://api.zoom.us/v2/users/{$userId}/status", [
            'json' => ['status' => $status],
        ]);
    }

    /**
     * Updates the password of an existing user.
     *
     * This method will update the password of the specified user.
     *
     * @param string $userId The unique ID of the user to update.
     * @param string $newPassword The new password to set for the user.
     * @return array The response data confirming the password update.
     */
    public function updateUserPassword(string $userId, string $newPassword): array
    {
        return $this->client->request('PUT', "https://api.zoom.us/v2/users/{$userId}/password", [
            'json' => ['password' => $newPassword],
        ]);
    }

    /**
     * Checks if a user email already exists in Zoom.
     *
     * This method will check if the specified email is already associated with an existing Zoom user.
     *
     * @param string $email The email to check for existence.
     * @return array The response data confirming whether the email exists or not.
     */
    public function checkUserEmailExists(string $email): array
    {
        return $this->client->request('GET', "https://api.zoom.us/v2/users/email/{$email}");
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
