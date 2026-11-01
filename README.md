# IronFence Coding Challenge

A Laravel 10 task manager with authentication, an AdminLTE interface and a kanban-style task dashboard.

## Context

Solution to the hiring challenge of IronFence (2025). The challenge statement is kept in [`docs/challenge.pdf`](docs/challenge.pdf) (in Portuguese), with the recruiters' e-mail addresses removed.

The work was done between 2025-07-13 and 2025-07-18 and stops at an early stage: tasks can be created, but the board does not display them yet (see Notes).

## What it does

- **Authentication** with `laravel/ui`: login, registration, password reset and logout. Every task route requires an authenticated user.
- **Tasks** (`tasks` table) belong to a user and have a description, a due date (`due_date`), a status (`pending`, `in_progress`, `completed`, or empty for Backlog) and a priority (`low`, `medium`, `high`).
- **Create a task** (`GET /tasks/create`, `POST /tasks`): the form uses a date-time picker and select inputs. `TaskRequest` validates the input, the controller saves the task for the logged-in user inside a database transaction, and the result is shown as a flash message.
- **Task dashboard** (`GET /tasks/dashboard`; `/`, `/home` and `/tasks` redirect to it): a kanban board with Backlog, pending, in progress and completed columns, built from the AdminLTE kanban layout.

The interface text is in Portuguese.

## Tech stack

Versions are taken from `composer.lock` and `package-lock.json`.

- PHP `^8.1` (the Docker image installs PHP 8.4)
- Laravel Framework 10.48.29, Laravel Sanctum 3.3.3, Laravel UI 4.6.1
- `laravelcollective/html` 6.4.1 (form helpers), `laracasts/flash` 3.2.4 (flash messages)
- AdminLTE (committed under `public/dist` and `public/plugins`), with jQuery, Select2 and Tempus Dominus
- Vite 5.4.19 with `laravel-vite-plugin` 1.3.0, Bootstrap 5.3.7, Sass 1.89.2
- MySQL 8.0 and Redis through Laravel Sail 1.43.1 (Docker Compose, Ubuntu 24.04 base image, Node 22)
- PHPUnit 10.5.48

## Running locally

Requirements: Docker with Docker Compose, plus Composer to install the PHP dependencies the first time (Sail lives in `vendor/`).

```bash
cp .env.example .env
composer install                      # or: make install
make start                            # ./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
make seed                             # migrate and seed
```

The application listens on `http://localhost` (port `APP_PORT`, default 80). MySQL is forwarded to port 33066 (`FORWARD_DB_PORT`).

When the `application` container starts, supervisord runs `docker/setup-container`, which runs the migrations, `npm install` and `npm run dev` (Vite dev server on port 5173).

`DatabaseSeeder` creates one user; you can also create an account at `/register`.

Other Makefile targets: `build`, `up`, `down`, `stop`, `restart`, `sh` (shell in the application container), `sh:mysql` (MySQL client), `migrate`, `npm` and `test`.

## Tests

```bash
make test                             # ./vendor/bin/sail test
```

The suite contains only the two example tests that ship with Laravel. Run on 2026-11-01 with PHP 8.3 in Docker (`php:8.3-cli`, after `composer install` and `php artisan key:generate`):

- `Tests\Unit\ExampleTest` passes.
- `Tests\Feature\ExampleTest` fails: it expects `GET /` to return 200, but `/` now redirects to `/home` (302).

Result: 1 passed, 1 failed. There are no tests for the task features.

## Project structure

```
app/Http/Controllers/TaskController.php   dashboard, create and store actions
app/Http/Requests/TaskRequest.php         validation of task input
app/Models/Task.php                       Task model, status and priority options
app/Models/User.php                       User model with the tasks() relation
database/migrations/                      Laravel defaults plus create_tasks_table
database/seeders/DatabaseSeeder.php       first user
resources/views/tasks/                    dashboard (kanban), create form, fields
resources/views/layouts/                  AdminLTE layout, navbar, sidebar, menu
routes/web.php                            auth routes and the /tasks group
docker/                                   Sail-based Dockerfile, supervisord and startup scripts
Makefile                                  shortcuts around Sail
```

## Notes

- The kanban columns contain the static example cards from the AdminLTE template. They are not loaded from the `tasks` table, so a created task is saved but does not appear on the board.
- There is no listing, editing, moving or deleting of tasks yet.
- `TaskRequest` applies the rule `date:y-m-d H:i` to `due_date`. Laravel's `date` rule ignores parameters, so the format is not enforced; `date_format` would enforce it.
- `routes/api.php` keeps only the default Sanctum `/user` route; the application has no API of its own.
