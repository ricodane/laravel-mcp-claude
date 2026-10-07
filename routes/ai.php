<?php

use Laravel\Mcp\Facades\Mcp;

Mcp::local('shelter', \App\Mcp\Servers\ShelterServer::class);

// Login addresses claude.ai reads to find where to sign in
Mcp::oauthRoutes();

// The same server over HTTP, for claude.ai
Mcp::web('/mcp', \App\Mcp\Servers\ShelterServer::class)
    // Only requests with a valid token get through
    ->middleware(['auth:api', 'throttle:mcp']);