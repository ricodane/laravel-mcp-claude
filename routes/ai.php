<?php

use Laravel\Mcp\Facades\Mcp;

// Claude Code on your machine
Mcp::local('shelter', \App\Mcp\Servers\ShelterServer::class);

// Login addresses claude.ai reads to find where to sign in
Mcp::oauthRoutes();

// Claude sends requests to this URL
Mcp::web('/mcp', \App\Mcp\Servers\ShelterServer::class)
    ->middleware('auth:api');
