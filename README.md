# Laravel MCP Server Example

Example code for the guide [How to Build a Laravel MCP Server and Connect It to Claude](https://www.tudlora.com/guides/how-to-build-a-laravel-mcp-server-and-connect-it-to-claude).

A Laravel MCP server lets Claude call functions in your app and answer questions using your real data. This repo is a small animal shelter app with a read-only server and one tool, `GetAnimalTool`, that looks up an animal by its ID. It connects to Claude Code on your machine, and online to claude.ai with a Passport login.

## What you'll need

- Laravel 12 (12.41.1 or newer) or Laravel 13
- PHP 8.2 or higher
- Claude Code, for the local part
- A public server with HTTPS, for the online part

## Setup

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan passport:keys
npm install && npm run build
```

## Run it locally

From the project root, tell Claude Code how to start the server:

```bash
claude mcp add shelter -- php artisan mcp:start shelter
```

Open Claude Code and type `/mcp`. You should see `shelter` listed as connected, along with its tool count. Then ask it something:

> is animal 8 still up for adoption?

To test the server before connecting Claude at all, use the built-in inspector:

```bash
php artisan mcp:inspector shelter
```

## Files you touched

- `routes/ai.php`: registers the server locally and online, plus the OAuth routes
- `app/Mcp/Servers/ShelterServer.php`: name, version, instructions, and the list of tools
- `app/Mcp/Tools/GetAnimalTool.php`: description, `handle()`, `schema()`
- `config/auth.php`: the `api` guard using Passport
- `app/Models/User.php`: `OAuthenticatable` and `HasApiTokens`
- `AppServiceProvider.php`: the approval view
- A sign-in page, if your Laravel app didn't have one
