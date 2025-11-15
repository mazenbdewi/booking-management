# Booking Management System - Laravel & Filament

## 1. طريقة تشغيل المشروع

### المتطلبات:

-   PHP >= 8.1
-   Composer
-   Laravel 12
-   MySQL أو MariaDB

### خطوات التثبيت:

1. استنساخ المشروع:

```bash
git clone https://github.com/USERNAME/booking-management.git
cd booking-management
```

2. تثبيت الاعتماديات:

```bash
composer install
npm install && npm run dev
```

3. إعداد ملف البيئة `.env`:

```bash
cp .env.example .env
php artisan key:generate
```

-   قم بتحديث إعدادات قاعدة البيانات في `.env`

4. تشغيل الـ migrations:

```bash
php artisan migrate
```

5- تحميل البرمشين
php artisan shield:install admin

6.  إنشاء ادمين و رولز stuf إداري:

````bash
php artisan make:initial-users

6. تشغيل الخادم المحلي:

```bash
php artisan serve
````

-   الوصول إلى لوحة الإدارة عبر `/placeofedit`

7. واجهة API:

تسجيل دخول

POST /api/login
Content-Type: application/json
{
"email": "admin@admin.com",
"password": "admin"
}

-   إنشاء حجز جديد:

```

POST /api/bookings
Accept :application/json
Content-Type: application/json
{
  "customer_name": "John Doe",
  "phone_number": "123456789",
  "booking_date": "2025-11-20 14:00:00",
  "service_id": 1,
  "notes": "Special request"
}
```

استعراض الحجوزات

GET /api/bookings
Accept :application/json
Content-Type: application/json
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
},
{
"id": 2,
"customer_name": "test 66",
"phone_number": "+32323232323232323",
"booking_date": "2025-11-15 15:15:51",
"booking_date_formatted": "15/11/2025 15:15",
"service": {
"id": 1,
"name": "test 1",
"description": "test test test",
"created_at": "2025-11-15 11:56:53",
"updated_at": "2025-11-15 11:56:53"
},
"notes": "ewewew",
"status": "Pending",
"created_at": "2025-11-15 12:15:55",
"created_at_formatted": "15/11/2025 12:15"
},
{
"id": 1,
"customer_name": "test 55",
"phone_number": "0958682674",
"booking_date": "2025-11-15 15:15:11",
"booking_date_formatted": "15/11/2025 15:15",
"service": {
"id": 1,
"name": "test 1",
"description": "test test test",
"created_at": "2025-11-15 11:56:53",
"updated_at": "2025-11-15 11:56:53"
},
"notes": "test note",
"status": "Cancelled",
"created_at": "2025-11-15 12:15:25",
"created_at_formatted": "15/11/2025 12:15"
}
]
}

---

## 2. هيكلة النظام

-   `app/Models/User.php` : نموذج المستخدم وعلاقاته
-   `app/Models/Booking.php` : نموذج الحجز وعلاقاته
-   `app/Models/Service.php` : نموذج الخدمات
-   `database/migrations/` : ملفات إنشاء الجداول (users, services, bookings)
-   `routes/api.php` : نقطة API لإنشاء الحجوزات
-   `routes/web.php` : صفحات Laravel العامة و Filament Admin Panel
-   `app/Filament/Resources/` : موارد Filament لإدارة المستخدمين والحجوزات والخدمات

---

## 3. قرارات وافتراضات تم اتخاذها

1. **فصل جدول الخدمات (`services`)** لجعل النظام أكثر ديناميكية وسهل الإضافة أو التعديل على أنواع الخدمات.
2. **ربط جدول الحجوزات بـ `service_id` و `created_by`** لضمان تكامل البيانات.
3. **تحديد ENUM للحالة (`Pending`, `Confirmed`, `Cancelled`)** لتسهيل إدارة حالة الحجز.
4. **تحديد دورين فقط للمستخدمين (`admin`, `staff`)** للتحكم بالوصول بشكل بسيط.
5. **إنشاء فهارس (`indexes`) على الأعمدة الأكثر استخدامًا في البحث** مثل: `booking_date`, `status`, `service_id`, `created_by`, `role`.
6. **استخدام Filament Admin Panel** لإدارة المستخدمين والحجوزات والخدمات بسهولة دون الحاجة لتطوير واجهة إدارة يدوية.
7. **نقطة API واحدة (`POST /api/bookings`)** لإنشاء الحجوزات، يمكن توسيعها لاحقًا لإضافة تحديث أو حذف الحجوزات أو استعراضها.
