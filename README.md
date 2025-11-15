# Booking Management System - Laravel & Filament

## 1. How to Run the Project

### Requirements:

-   PHP >= 8.1
-   Composer
-   Laravel 12
-   MySQL or MariaDB

### Installation Steps:

1. **Clone the project:**

```bash
git clone https://github.com/mazenbdewi/booking-management.git
cd booking-management

2.Install dependencies:

composer install
npm install && npm run dev


3.Set up the environment file .env:

cp .env.example .env
php artisan key:generate

Update your database settings in .env.

4.Run migrations:
php artisan migrate

5.Install Filament Shield:
php artisan shield:install admin

6.Create an initial admin and staff roles:
php artisan make:initial-users

7.Start the local server:
php artisan serve

Access the admin panel via /placeofedit.


API Endpoints

Login:
POST /api/login
Content-Type: application/json
{
  "email": "admin@admin.com",
  "password": "admin"
}

Create a new booking:
POST /api/bookings
Accept: application/json
Content-Type: application/json
{
  "customer_name": "John Doe",
  "phone_number": "123456789",
  "booking_date": "2025-11-20 14:00:00",
  "service_id": 1,
  "notes": "Special request"
}

View bookings:
GET /api/bookings
Accept: application/json
Content-Type: application/json


Example Response:
{
  "status": "success",
  "message": "success get data",
  "data": [
    {
      "id": 3,
      "customer_name": "Mazen Bdewi",
      "phone_number": "+41791234567",
      "booking_date": "2025-11-20 15:30:00",
      "booking_date_formatted": "20/11/2025 15:30",
      "service": {
        "id": 1,
        "name": "test 1",
        "description": "test test test",
        "created_at": "2025-11-15 11:56:53",
        "updated_at": "2025-11-15 11:56:53"
      },
      "notes": "Test booking",
      "status": "Pending",
      "created_at": "2025-11-15 17:39:36",
      "created_at_formatted": "15/11/2025 17:39"
    }
  ]
}



2. System Structure

app/Models/User.php – User model and relationships

app/Models/Booking.php – Booking model and relationships

app/Models/Service.php – Service model

database/migrations/ – Table creation files (users, services, bookings)

routes/api.php – API endpoint for creating bookings

app/Filament/Resources/ – Filament resources for managing users, bookings, and services

3. Decisions and Assumptions

Separate services table to make the system more dynamic and easy to add or edit service types.

Bookings linked to service_id and created_by for data integrity.

Use ENUM for status (Pending, Confirmed, Cancelled) to simplify booking status management.

Two user roles only (admin, staff) for simple access control.

Indexes on frequently searched columns: booking_date, status, service_id, created_by, role.

Filament Admin Panel is used for managing users, bookings, and services without building a custom admin interface.

Single API endpoint (POST /api/bookings) for creating bookings, which can be extended later to update, delete, or view bookings.

An Artisan command was created to generate the first admin user, assign them the super_admin role, and create the staff role for other users.
```
