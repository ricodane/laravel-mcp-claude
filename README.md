# Laravel MCP server example: connect a Laravel app to Claude

The example app for the Tudlora guide
[How to Build a Laravel MCP Server and Connect It to Claude](https://www.tudlora.com/guides/how-to-build-a-laravel-mcp-server-and-connect-it-to-claude).

It's a small animal shelter app with one MCP tool, `get-animal-tool`, that Claude can call to look up an animal by ID.
The same server runs two ways:

- **Locally**, started by Claude Code, with no login
- **Over HTTP** at `/mcp`, protected by Laravel Passport OAuth, so Claude Code and claude.ai custom connectors can sign in

The guide explains every step. This repo is the finished result.

## Requirements

- PHP 8.3 or higher, and Composer
- Node.js and npm
- [Claude Code](https://claude.com/claude-code)

## Setup

```bash
git clone https://github.com/ricodane/laravel-mcp-claude.git
cd laravel-mcp-claude

composer install
cp .env.example .env
php artisan key:generate

# Creates the tables, a test user and 8 animals (SQLite by default)
php artisan migrate --seed

# Passport's signing keys are gitignored, so each copy of the app makes its own
php artisan passport:keys

# Builds the styles for the approval screen
npm install
npm run build
```

The seeded test user is `test@example.com` with the password `password`.

## Try it locally in Claude Code

```bash
claude mcp add shelter -- php artisan mcp:start shelter
```

Open Claude Code from this folder, then ask:

> Is animal 8 still up for adoption?

Claude calls `get-animal-tool` and answers with Biscuit, a 2-year-old Corgi.

## Try it over HTTP with OAuth

```bash
php artisan serve
```

In another terminal:

```bash
claude mcp add --transport http shelter-web http://127.0.0.1:8000/mcp
```

Open Claude Code from this folder, type `/mcp`, select `shelter-web` and choose **Authenticate**. Sign in with the test user, click **Authorize**, then ask the same question.

claude.ai connects from the internet, so it needs the app on a public HTTPS address. See Steps 11 and 12 of the guide.

## Where things are

| File | What it does |
| --- | --- |
| `app/Mcp/Tools/GetAnimalTool.php` | The `get-animal-tool` tool, with its permission check |
| `app/Mcp/Servers/ShelterServer.php` | The MCP server and the tools it offers |
| `routes/ai.php` | The local server, the OAuth routes and the `/mcp` route |
| `routes/web.php` | The sign-in routes |
| `resources/views/login.blade.php` | The sign-in form |
| `resources/views/mcp/authorize.blade.php` | The approval screen |
| `app/Providers/AppServiceProvider.php` | The approval view, the `view-animals` gate, token lifetimes and the rate limit |
| `app/Models/User.php`, `config/auth.php` | Passport setup |

Last checked with laravel/mcp 1.0.1 and Laravel Passport 13.8 on Laravel 13.34 (PHP 8.4), October 2026.
