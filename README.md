# MonkeyBizz API

A Laravel-based RESTful API with authentication, repository pattern, and best practices implementation.

## Requirements

- PHP >= 8.2
- Composer
- MySQL >= 5.7
- Git

## Local Development Setup

1. Clone the repository
```bash
git clone git@github.com:echicajames/monkeybizz-api.git
cd monkeybizz-api
```

2. Install dependencies
```bash
composer install
```

3. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure your database in `.env`
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=monkeybizz
DB_USERNAME=root
DB_PASSWORD=
```

5. Create database and run migrations
```bash
mysql -u root -e "CREATE DATABASE IF NOT EXISTS monkeybizz;"
php artisan migrate
```

6. Start the development server
```bash
php artisan serve
```

The API will be available at `http://localhost:8000`

## API Documentation

### Authentication Endpoints

#### Register a New User
```http
POST /api/v1/register
```

**Request Body:**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "your_password",
    "password_confirmation": "your_password"
}
```

**Response:**
```json
{
    "status": "success",
    "message": "User registered successfully",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "created_at": "2024-05-26T14:30:00.000000Z",
            "updated_at": "2024-05-26T14:30:00.000000Z"
        },
        "token": "your_access_token"
    }
}
```

#### Login
```http
POST /api/v1/login
```

**Request Body:**
```json
{
    "email": "john@example.com",
    "password": "your_password"
}
```

**Response:**
```json
{
    "status": "success",
    "message": "Logged in successfully",
    "data": {
        "user": {
            "id": 1,
            "name": "John Doe",
            "email": "john@example.com",
            "created_at": "2024-05-26T14:30:00.000000Z",
            "updated_at": "2024-05-26T14:30:00.000000Z"
        },
        "token": "your_access_token"
    }
}
```

#### Get User Profile
```http
GET /api/v1/user
```

**Headers:**
```
Authorization: Bearer your_access_token
```

**Response:**
```json
{
    "status": "success",
    "message": null,
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "created_at": "2024-05-26T14:30:00.000000Z",
        "updated_at": "2024-05-26T14:30:00.000000Z"
    }
}
```

#### Logout
```http
POST /api/v1/logout
```

**Headers:**
```
Authorization: Bearer your_access_token
```

**Response:**
```json
{
    "status": "success",
    "message": "Logged out successfully",
    "data": null
}
```

## Error Responses

The API returns consistent error responses in the following format:

```json
{
    "status": "error",
    "message": "Error message description",
    "data": null
}
```

Common HTTP status codes:
- 200: Success
- 201: Created
- 400: Bad Request
- 401: Unauthorized
- 403: Forbidden
- 404: Not Found
- 422: Validation Error
- 500: Server Error

## Security

The API implements multiple layers of security to protect against various threats:

### Authentication & Authorization
- **Laravel Sanctum**: Implements token-based authentication for API requests
- **Token Management**: Secure token generation and validation for API access
- **Stateless Authentication**: Pure API token authentication for stateless requests
- **SPA Support**: Configured for secure Single Page Application integration

### Password Security
- **Strong Password Policy**: Requires minimum length, mixed case, numbers, and symbols
- **Password Hashing**: Uses secure bcrypt hashing for password storage
- **Password Validation**: Checks against known compromised passwords
- **Secure Password Reset**: Implements secure password reset functionality

### Request Protection
- **Rate Limiting**: Prevents brute force attacks on authentication endpoints
- **CSRF Protection**: Implemented for cookie-based authentication
- **Middleware Security**: 
  - `api` middleware group for API-specific protections
  - `auth:sanctum` middleware for protected routes
  - Request throttling for API endpoints

### Data Protection
- **Input Validation**: Strict validation of all incoming requests
- **SQL Injection Prevention**: Using Laravel's query builder and Eloquent ORM
- **XSS Protection**: Automatic escaping of output
- **CORS Configuration**: Configured for secure cross-origin requests
- **Sensitive Data Hiding**: Automatic hiding of sensitive attributes (password, remember_token)

### HTTP Security
- **Secure Headers**: Implementation of security-related HTTP headers
- **TLS Support**: Ready for HTTPS implementation
- **Content Security Policy**: Can be configured for additional security
- **Response Sanitization**: Proper formatting and sanitization of API responses

### Best Practices
- **Environment Configuration**: Secure environment variable handling
- **Error Handling**: Safe error reporting in production
- **Logging**: Security-related event logging
- **Updates**: Regular security patches and updates

## Architecture

The API follows these architectural patterns and principles:
- Repository Pattern for data abstraction
- Service Layer for business logic
- Middleware-based request handling
- Consistent API response structure

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
