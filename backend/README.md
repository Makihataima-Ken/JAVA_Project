# Backend API

This repository contains a Laravel backend API for a simple order management system.

## Overview

The application includes:
- JWT-based authentication for users.
- User registration, login, profile fetch, and logout.
- Order submission with an optional file upload.
- User-specific order listing and order detail retrieval.
- Admin endpoints for approving, rejecting, and listing orders.

## Built With

- PHP ^8.2
- Laravel Framework ^11.9
- tymon/jwt-auth ^2.1 for JWT authentication

## API Endpoints

### Authentication

- `POST /api/auth/register`
  - Register a new user.
  - Required fields: `first_name`, `last_name`, `phone_number`, `password`.
  - Returns JWT bearer token and user data.

- `POST /api/auth/login`
  - Authenticate existing user.
  - Required fields: `phone_number`, `password`.
  - Returns JWT bearer token and user data.

- `GET /api/auth/profile`
  - Fetch authenticated user profile.
  - Requires bearer token.

- `POST /api/auth/logout`
  - Logout the current user.
  - Requires bearer token.

### Order Management

- `POST /api/orders/add_order`
  - Create a new order.
  - Supported fields: `university`, `major`, `type`, `description`, `deadline`, and optional `file_path`.
  - Saves the order with status `pending`.

- `DELETE /api/orders/cancel_order/{id}`
  - Cancel a pending order by ID.
  - Only `pending` orders can be canceled.

- `GET /api/orders/user_orders`
  - Return the authenticated user’s orders.
  - Includes summary overview for each order.

- `GET /api/orders/order_details/{id}`
  - Return details for a specific order.

### Admin Actions

- `POST /api/approve_order/{id}`
  - Approve an order and update its status to `in progress`.

- `POST /api/reject_order/{id}`
  - Reject an order and delete it.

- `GET /api/pending_orders`
  - List orders with status `pending`.

- `GET /api/approved_orders`
  - List orders with status `in progress`.

## Key Models and Controllers

- `app/Models/User.php`
  - Defines JWT subject methods.
  - Relationship: `User` has many `orders`.

- `app/Models/Order.php`
  - Defines order fields and mass assignment rules.
  - Provides an order overview method used by list endpoints.

- `app/Http/Controllers/Auth/RegisterController.php`
  - Creates new users and returns a JWT.

- `app/Http/Controllers/Auth/LoginController.php`
  - Authenticates users and returns a JWT.

- `app/Http/Controllers/OrderController.php`
  - Handles order creation, cancellation, listing, and details.

- `app/Http/Controllers/AdminController.php`
  - Handles order approval, rejection, and admin order listing.

## Installation

1. Copy `.env.example` to `.env` and configure database credentials.
2. Run `composer install`.
3. Generate app key: `php artisan key:generate`.
4. Run database migrations: `php artisan migrate`.
5. Generate JWT secret: `php artisan jwt:secret`.
6. Start the server: `php artisan serve`.

## Notes

- This project uses JWT authentication for API access.
- Uploaded files for orders are stored in the `public/uploads` disk.
- The admin endpoints currently use simple order status updates and deletion logic.

## License

This project is licensed under the MIT License.