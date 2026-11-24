# Helpdesk API

A support-ticket API with priorities, assignment, and lifecycle states.

> Portfolio demo by Hossam Elkady. Built with PHP 8.2+, Laravel 11, and SQLite for local development.

![Static Helpdesk API UI preview](docs/preview.svg)

**Preview note:** the image is a static concept illustration for this API demo, not a screenshot of a running app. This repository focuses on the API; it does not claim a deployed service.

## What it demonstrates

- RESTful CRUD endpoints with JSON responses and pagination.
- Request validation and consistent error handling through Laravel.
- Resource-specific persistence, field validation, and test examples.
- Eloquent model, migration, and a focused feature-test suite.
- Lightweight local setup using SQLite.

## Data model

- `subject`: string
- `requester_email`: string
- `description`: text
- `priority`: string default normal
- `status`: string default open
- `assignee`: string nullable

## Requirements and setup

- PHP 8.2+
- Composer 2

```bash
cp .env.example .env
composer install
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

The app runs at `http://127.0.0.1:8000`. The API is intentionally unauthenticated for a short portfolio sandbox. Do not use it for real personal or customer data.

## API

| Method | Endpoint | Purpose |
|---|---|---|
| GET | `/api/health` | Health check |
| GET | `/api/tickets` | Paginated list (15 per page) |
| POST | `/api/tickets` | Create a record |
| GET | `/api/tickets/{id}` | Read one record |
| PUT/PATCH | `/api/tickets/{id}` | Update a record |
| DELETE | `/api/tickets/{id}` | Delete a record |

Example create request:

```bash
curl -X POST http://127.0.0.1:8000/api/tickets \
  -H 'Accept: application/json' -H 'Content-Type: application/json' \
  -d '{"subject": "Cannot export monthly report", "requester_email": "maya@example.test", "description": "The CSV export stops after loading.", "priority": "high", "status": "open", "assignee": "Support team"}'
```

## Tests

```bash
php artisan test
```

The feature tests cover the health check, create/list flow, and invalid input. PHP/Composer are not bundled; install dependencies locally before running tests.

## Design notes

- Form validation uses Laravel's JSON validation response (HTTP 422).
- IDs use implicit route model binding; missing records return 404.
- Paginated responses use Laravel's standard pagination envelope.
- The demo keeps domain scope small so the endpoints are easy to inspect.

## License

MIT. See [LICENSE](LICENSE).
