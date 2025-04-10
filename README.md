# Laravel 9 REST API - User CRUD & Real-time Search

This is a RESTful API built with **Laravel 9**, supporting:
- Authentication via Laravel Sanctum
- User CRUD operations
- Real-time data search from external JSON source
- Token-protected endpoints

## 🚀 Tech Stack

- Laravel 9
- Sanctum (for API token authentication)
- MySQL
- Postman (for testing)
- HTTP client for fetching external data

---

## 📦 Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/laravel-api-project.git
cd laravel-api-project
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Environment Setup

Copy `.env.example` to `.env` and update your database credentials:

```bash
cp .env.example .env
```

```env
DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_pass
```

Generate app key:

```bash
php artisan key:generate
```

### 4. Migrate Database

```bash
php artisan migrate
php artisan db:seed --class=UsersTableSeeder
```

### 5. Serve the App

```bash
php artisan serve
```

---

## 🔐 Authentication

This project uses **Sanctum** for token-based API authentication.

### 🧪 Login

**Endpoint:**
```
POST /api/login
```

**Body:**
```json
{
  "email": "user@example.com",
  "password": "password123"
}
```

**Response:**
```json
{
  "token": "your_api_token_here"
}
```

Use the token as a Bearer token in the `Authorization` header for the following endpoints.

---

## 📚 API Endpoints

All authenticated endpoints require:

```
Authorization: Bearer {token}
```

### 👤 User CRUD

| Method | Endpoint         | Description          |
|--------|------------------|----------------------|
| GET    | /api/users       | List all users       |
| POST   | /api/users       | Create a new user    |
| GET    | /api/users/{id}  | Get single user      |
| PUT    | /api/users/{id}  | Update a user        |
| DELETE | /api/users/{id}  | Delete a user        |

### 🧠 Search (External Data)

All search queries fetch real-time data from an external JSON file.

#### 🔎 Search by Name
```
GET /api/search?NAMA=Turner Mia
```

#### 🔎 Search by NIM
```
GET /api/search?NIM=9352078461
```

#### 🔎 Search by YMD
```
GET /api/search?YMD=20230405
```

---

## 📑 Notes

- Passwords are hashed using Bcrypt
- Validation handled via a unified `UserRequest`
- External data source: [https://bit.ly/48ejMhW](https://bit.ly/48ejMhW)

---

## 📜 License

MIT – free to use and modify.
