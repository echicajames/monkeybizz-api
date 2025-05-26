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

- API uses Laravel Sanctum for authentication
- Implements token-based authentication
- CORS configured for frontend applications
- Password validation and hashing
- Protection against common web vulnerabilities

## Architecture

The API follows these architectural patterns and principles:
- Repository Pattern for data abstraction
- Service Layer for business logic
- API Resource Transformers
- Request Validation
- Response standardization
- API versioning (v1)

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
