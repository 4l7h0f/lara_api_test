# Laravel 9 RESTful API - User Management & Realtime Search

This is a Laravel 9-based REST API project that supports:
- User Authentication using Laravel Sanctum
- CRUD operations for user accounts
- Realtime search functionality by fetching external data
- Authenticated access for all critical endpoints
- Postman collection for API testing
- MySQL database backup provided

## 🛠️ Tech Stack
- Laravel 9
- Laravel Sanctum
- MySQL
- Postman

## 🔐 Authentication
The API uses **Laravel Sanctum** for token-based authentication. Login to retrieve an API token which must be used in the `Authorization` header for protected routes.

---

## 📦 API Endpoints

### 🔑 Authentication
| Method | Endpoint     | Description        |
|--------|--------------|--------------------|
| POST   | /api/login   | User login to get API token |

**Request Body:**
```json
{
  "email": "user@example.com",
  "password": "password"
}
