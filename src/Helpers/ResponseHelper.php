<?php

namespace Abdulbaset\ZoomIntegration\Helpers;

class ResponseHelper
{
    /**
     * Generates a standardized response array with status, message, and optional data.
     * If the status is 400 and a specific error code (4711) is present in the data,
     * the function will also add any missing scopes to the response.
     *
     * @param int $status The HTTP status code to return, e.g., 200 for success, 400 for error.
     * @param string $message A message providing details about the response.
     * @param mixed|null $data Optional data to include in the response (e.g., payload or error details).
     * @return array The constructed response array containing status, message, response data,
     *               and missing scopes (if applicable).
     */
    public static function response($status, $message, $data = null): array
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'response' => $data,
        ];

        // Checks if there is a specific error case (status 400 with code 4711).
        // If so, it extracts any missing scopes from the error message.
        if ($status === 400 && isset($data['code']) && $data['code'] === 4711) {
            $response['missing_scopes'] = self::extractMissingScopes($data['message']);
        }

        return $response;
    }

    /**
     * Extracts the missing scopes from a message string, if present.
     * This method searches the message for a pattern like 'scopes:[scope1, scope2]',
     * then returns an array of individual scope names.
     *
     * @param string $message The error message string that may contain missing scopes.
     * @return array An array of missing scope names. If no scopes are found, it returns an empty array.
     */
    private static function extractMissingScopes($message): array
    {
        preg_match('/scopes:\[(.*?)\]/', $message, $matches);

        // If a match is found, split the scopes by commas, trim any whitespace, and return the array.
        if (isset($matches[1])) {
            return array_map('trim', explode(',', $matches[1]));
        }

        // Return an empty array if no scopes are found in the message.
        return [];
    }
}
