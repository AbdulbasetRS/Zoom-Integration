<?php

namespace Abdulbaset\ZoomIntegration\Interfaces;

interface ZoomUserManagementInterface
{
    /**
     * Creates a new user with the specified details.
     *
     * This method will make a request to the Zoom API to create a new user in the Zoom system.
     *
     * @param array $userData An array containing the user's details such as email, first name, last name, etc.
     * @return array The response data containing details of the newly created user.
     */
    public function createUser(array $userData): array;

    /**
     * Updates the details of an existing user.
     *
     * This method will make a request to the Zoom API to update the details of an existing user.
     *
     * @param string $userId The unique ID of the user to update.
     * @param array $updatedData An array containing the updated details of the user.
     * @return array The response data confirming the user's update.
     */
    public function updateUser(string $userId, array $updatedData): array;

    /**
     * Retrieves information of a specific user by ID or the authenticated user.
     *
     * This method interacts with the Zoom API to get details of a user by their unique user ID.
     * If no user ID is provided or 'me' is passed, it retrieves the details of the authenticated user.
     *
     * @param string $userId The ID of the user to retrieve details for, or 'me' for the authenticated user.
     * @return array The response data containing user details.
     */
    public function getUser(string $userId = 'me'): array;

    /**
     * Deletes a user by their ID.
     *
     * This method will make a request to the Zoom API to delete a user from the Zoom system.
     *
     * @param string $userId The unique ID of the user to delete.
     * @return array The response data confirming the deletion.
     */
    public function deleteUser(string $userId): array;

    /**
     * Lists all users with the specified status.
     *
     * This method will retrieve a list of all users based on their status (e.g., active, inactive).
     *
     * @param string $status The status of the users to list (default is 'active').
     * @param int $pageSize The number of users to retrieve per page.
     * @param int $pageNumber The page number to retrieve.
     * @return array The response data containing a list of users.
     */
    public function listUsers(string $status = 'active', int $pageSize = 30, int $pageNumber = 1): array;

    /**
     * Changes the status of a user (e.g., from active to inactive).
     *
     * This method will make a request to the Zoom API to change the status of a user.
     *
     * @param string $userId The unique ID of the user to change the status for.
     * @param string $status The new status to assign to the user (e.g., 'active', 'inactive').
     * @return array The response data confirming the status change.
     */
    public function changeUserStatus(string $userId, string $status): array;

    /**
     * Updates the password of a user.
     *
     * This method will make a request to the Zoom API to update the password of a user.
     *
     * @param string $userId The unique ID of the user whose password is being updated.
     * @param string $newPassword The new password to assign to the user.
     * @return array The response data confirming the password change.
     */
    public function updateUserPassword(string $userId, string $newPassword): array;

    /**
     * Checks if an email address already exists in the Zoom system.
     *
     * This method will check if the provided email is already associated with a Zoom user.
     *
     * @param string $email The email address to check.
     * @return array The response data confirming whether the email exists.
     */
    public function checkUserEmailExists(string $email): array;
}
