<?php

namespace App\Mcp\Servers;

use App\Mcp\Tools\GetAnimalTool;
use Laravel\Mcp\Server;
use Laravel\Mcp\Server\Attributes\Instructions;
use Laravel\Mcp\Server\Attributes\Name;
use Laravel\Mcp\Server\Attributes\Version;

// Name, version and instructions are shown to Claude when it connects
#[Name('Shelter Server')]
#[Version('0.0.1')]
#[Instructions('Read-only access to shelter animal records.')]
class ShelterServer extends Server
{
    // Only tools listed here are visible to Claude
    protected array $tools = [
        GetAnimalTool::class,
    ];
}