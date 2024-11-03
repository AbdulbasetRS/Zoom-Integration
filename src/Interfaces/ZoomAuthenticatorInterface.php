<?php

namespace Abdulbaset\ZoomIntegration\Interfaces;

interface ZoomAuthenticatorInterface
{
    /**
     * Authenticates the user or application with Zoom and retrieves an access token.
     * This method should implement the logic required to authenticate using Zoom's API.
     * 
     * @return string The access token obtained after successful authentication.
     */
    public function authenticate(): string;
}
