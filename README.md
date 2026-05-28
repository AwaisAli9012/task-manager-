# Task Manager

A professional Team Task Manager built with Laravel 13, Vue.js, and PostgreSQL.

## Features

- User authentication (register, login, logout)
- Create, update, and delete tasks
- Task status management (Pending, In Progress, Completed)
- Dashboard with task statistics
- REST API with Sanctum token authentication
- API documentation with Scramble
- Rate limiting on task creation
- Automated tests with Pest

## Tech Stack

- **Backend:** Laravel 13, PHP 8.3
- **Frontend:** Vue.js 3, Inertia.js, Tailwind CSS
- **Database:** PostgreSQL
- **Authentication:** Laravel Fortify + Sanctum
- **Testing:** Pest
- **API Docs:** Scramble
- **DevOps:** Docker, Laravel Sail

## Setup Instructions

### Requirements
- Docker Desktop
- Git

### Installation

1. Clone the repository
```bash
git clone https://github.com/AwaisAli9012/task-manager-.git
cd task-manager-
```

2. Copy environment file
```bash
cp .env.example .env
```

3. Start Docker containers
```bash
./vendor/bin/sail up -d
```

4. Run migrations
```bash
./vendor/bin/sail artisan migrate
```

5. Start frontend
```bash
./vendor/bin/sail npm run dev
```

6. Visit http://localhost

## API Documentation

Visit http://localhost/docs/api to see all available API endpoints.

## Running Tests

```bash
./vendor/bin/sail artisan test
```