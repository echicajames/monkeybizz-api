# API Routes Documentation

## Directory Structure

```
routes/api/
├── v1/                     # Version 1 of the API
│   ├── auth/              # Authentication related routes
│   │   └── routes.php     # Authentication endpoints
│   ├── user/              # User management routes
│   │   └── routes.php     # User profile endpoints
│   ├── stock/             # Stock management routes
│   │   └── routes.php     # Stock CRUD endpoints
│   ├── branch/            # Branch management routes
│   │   └── routes.php     # Branch CRUD endpoints
│   └── inventory/         # Inventory management routes
│       └── routes.php     # Inventory CRUD endpoints
└── README.md              # This documentation file
```

## Route Groups

### Authentication Routes (`/api/v1/*`)
- `POST /register` - Register a new user
- `POST /login` - User login
- `POST /logout` - User logout (requires authentication)
- `GET /user` - Get authenticated user info (requires authentication)

### User Management Routes (`/api/v1/users/*`)
- User profile management endpoints (protected routes)

### Stock Management Routes (`/api/v1/stocks/*`)
- `GET /stocks` - List all stocks (requires authentication)
- `POST /stocks` - Create a new stock (requires authentication)
- `GET /stocks/{id}` - Get stock details (requires authentication)
- `PUT /stocks/{id}` - Update stock details (requires authentication)
- `DELETE /stocks/{id}` - Delete a stock (requires authentication)

### Branch Management Routes (`/api/v1/branches/*`)
- `GET /branches` - List all branches (requires authentication)
- `POST /branches` - Create a new branch (requires authentication)
- `GET /branches/{id}` - Get branch details (requires authentication)
- `PUT /branches/{id}` - Update branch details (requires authentication)
- `DELETE /branches/{id}` - Delete a branch (requires authentication)

### Inventory Management Routes (`/api/v1/inventory/*`)
- `GET /inventory` - List all inventory records (requires authentication)
- `POST /inventory` - Create a new inventory record (requires authentication)
- `GET /inventory/{id}` - Get inventory record details (requires authentication)
- `PUT /inventory/{id}` - Update inventory record details (requires authentication)
- `DELETE /inventory/{id}` - Delete an inventory record (requires authentication)

## Middleware Groups

### Public Routes
- No authentication required
- Rate limiting applied (60 requests per minute)

### Protected Routes
- Requires valid authentication token
- Uses Laravel Sanctum for authentication
- Rate limiting applied (60 requests per minute)

## Adding New Routes

1. Create a new directory under the appropriate version folder (e.g., `routes/api/v1/new-feature/`)
2. Create a `routes.php` file in the new directory
3. Define your routes using the Route group pattern
4. Include the new routes file in `routes/api.php`

Example:
```php
// routes/api/v1/new-feature/routes.php
Route::group([
    'prefix' => 'new-feature',
    'middleware' => ['auth:sanctum']
], function () {
    Route::get('/endpoint', [Controller::class, 'method'])->name('new-feature.endpoint');
});
```

## Best Practices

1. Always use route names for generating URLs
2. Group related routes together
3. Use appropriate HTTP methods (GET, POST, PUT, DELETE)
4. Apply middleware at the group level when possible
5. Keep route files focused and maintainable
6. Document new endpoints in this README 