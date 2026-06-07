# JAVA_Project

## Project Overview

This repository contains a full-stack application with:

- `backend/` — a Laravel API backend using PHP 8.2, JWT authentication, Eloquent models, migrations, and tests.
- `frontend/` — a Flutter mobile app for Android and iOS that consumes the backend API.

## Repository Structure

- `backend/`
  - Laravel application source code
  - `app/`, `config/`, `database/`, `routes/`, `tests/`
  - `composer.json` for PHP dependencies
  - `package.json` for frontend asset tooling via Vite
- `frontend/`
  - Flutter application source code
  - `lib/`, `android/`, `ios/`
  - `pubspec.yaml` for Dart and Flutter dependencies

## Prerequisites

- PHP 8.2+
- Composer
- Node.js and npm
- Flutter SDK
- A database engine supported by Laravel (e.g. MySQL, SQLite, PostgreSQL)
- Optional: Android Studio / Xcode for mobile device emulation

## Backend Setup (`backend/`)

1. Navigate to the backend folder:
   ```bash
   cd backend
   ```
2. Install PHP dependencies:
   ```bash
   composer install
   ```
3. Copy the environment example and configure your database credentials:
   ```bash
   cp .env.example .env
   ```
4. Generate the application key:
   ```bash
   php artisan key:generate
   ```
5. Run database migrations:
   ```bash
   php artisan migrate
   ```
6. Install Node dependencies and build assets (optional if using Laravel Vite assets):
   ```bash
   npm install
   npm run dev
   ```

### Run the backend server

```bash
php artisan serve
```

The API should be available at `http://127.0.0.1:8000` by default.

## Frontend Setup (`frontend/`)

1. Navigate to the frontend folder:
   ```bash
   cd frontend
   ```
2. Install Flutter dependencies:
   ```bash
   flutter pub get
   ```
3. Run the app on an emulator or device:
   ```bash
   flutter run
   ```

## Testing

### Backend tests

From `backend/`:

```bash
php artisan test
```

### Flutter tests

From `frontend/`:

```bash
flutter test
```

## Notes

- The backend currently uses JWT authentication via `tymon/jwt-auth`.
- The Flutter frontend includes state management with `flutter_bloc` and networking with `dio`.

## Additional Resources

- [Laravel documentation](https://laravel.com/docs)
- [Flutter documentation](https://docs.flutter.dev)
