# PR Systems

A modern Laravel 12 application built with Vue 3, Inertia.js, and Tailwind CSS 4.

## Tech Stack

### Backend
- **PHP** 8.2+
- **Laravel** 12.0
- **Inertia.js** 2.0
- **Laravel Fortify** 1.30 (Authentication)
- **Laravel Wayfinder** 0.1.9 (Type-safe routing)
- **Pest** 4.3 (Testing)

### Frontend
- **Vue** 3.5
- **TypeScript** 5.2
- **Tailwind CSS** 4.1
- **Reka UI** 2.6 (Component library)
- **VueUse** 12.8
- **Lucide Vue** (Icons)

### Development Tools
- **Laravel Pint** (Code formatting)
- **Laravel Pail** (Log viewer)
- **Laravel Sail** (Docker environment)
- **Laravel Boost** (MCP server)
- **ESLint** & **Prettier**

## Requirements

- PHP 8.2 or higher
- Composer
- Node.js & npm
- SQLite (default) or MySQL/PostgreSQL

## Installation

### Quick Setup

```bash
composer setup
```

This command will:
- Install PHP dependencies
- Copy `.env.example` to `.env`
- Generate application key
- Run database migrations
- Install Node dependencies
- Build frontend assets

### Manual Setup

```bash
# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Create SQLite database
touch database/database.sqlite

# Run migrations
php artisan migrate

# Install Node dependencies
npm install

# Build assets
npm run build
```

## Development

### Start Development Server

```bash
composer dev
```

This starts:
- Laravel development server (port 8000)
- Queue worker
- Log viewer (Pail)
- Vite dev server (HMR)

### With SSR Support

```bash
composer dev:ssr
```

### Individual Commands

```bash
# Start Vite dev server only
npm run dev

# Start Laravel server
php artisan serve

# Watch queue jobs
php artisan queue:listen

# View logs
php artisan pail
```

## Testing

```bash
# Run all tests with linting
composer test

# Run tests only
php artisan test

# Run specific test
php artisan test --filter=TestName

# Compact output
php artisan test --compact
```

## Code Quality

### Formatting

```bash
# Format PHP code
composer lint
# or
vendor/bin/pint

# Format frontend code
npm run format

# Check formatting
npm run format:check
```

### Linting

```bash
# Lint and fix JavaScript/Vue
npm run lint

# Test PHP formatting
composer test:lint
```

## Building for Production

```bash
# Build frontend assets
npm run build

# Build with SSR
npm run build:ssr
```

## Project Structure

```
app/                    # Application code
├── Http/
│   ├── Controllers/    # Controllers
│   └── Requests/       # Form requests
├── Models/             # Eloquent models
└── ...

resources/
├── js/
│   ├── actions/        # Wayfinder generated actions
│   ├── components/     # Vue components
│   ├── layouts/        # Layout components
│   ├── pages/          # Inertia pages
│   └── routes/         # Wayfinder generated routes
└── views/              # Blade views

routes/
├── web.php             # Web routes
├── api.php             # API routes
└── console.php         # Console routes

tests/
├── Feature/            # Feature tests
└── Unit/               # Unit tests
```

## Environment Configuration

Key environment variables:

```env
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=sqlite

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
```

## Laravel Herd

This application is configured to work with Laravel Herd. The site will be automatically available at:

```
http://pr-systems.test
```

## Features

- ✅ Modern Laravel 12 structure
- ✅ Vue 3 with TypeScript
- ✅ Inertia.js for SPA experience
- ✅ Type-safe routing with Wayfinder
- ✅ Authentication with Fortify
- ✅ Tailwind CSS 4 with custom components
- ✅ Pest testing framework
- ✅ Code formatting with Pint & Prettier
- ✅ Hot Module Replacement (HMR)
- ✅ SSR support

## License

MIT
