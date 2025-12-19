<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Simple Appointment Booking System

A simple appointment booking backend API built using Laravel 10.
The API is consumed by a Vue 3 Single Page Application (SPA) and tested using Postman.

This is a backend API system handles services, working hours, availability calculation, and appointment bookings.

## Tech Stack & Prerequisites
- PHP v8.2
- Laravel v10.x
- MySQL v8.x
- Composer v2.9

# Setup
You can clone this repository using the git clone.
 After clone, Run these commands one by one:

 ```composer install```

 ```cp .env.example .env```

 ```php artisan key:generate```

Now, Create a database (e.g. `booking_db`) and update the following values in `.env`:

- DB_DATABASE=booking_db
- DB_USERNAME=root
- DB_PASSWORD=your_db_password

After this, Run:

```php artisan migrate```

```php artisan db:seed```


Then, start your api server by running the below command:

```php artisan serve --port=8000```

Then your api server will run on http://localhost:8000



# Information about APIs

**Common API:**
1. /api/services - GET - Get All Services List
2. /api/weekdays - GET - Get All Weekdays List

**Admin API:**
1. /api/admin/working-hours/list - GET - Get List of saved working hours by each weekday.
2. /api/admin/working-hours/store - POST - Save the Working hours based on weekday.

**Client API**
1. /api/availability - GET - User can check the available timeslots for the given date and service based on working hours and existing bookings.(Date cannot be the past date). 
2. /api/bookings - POST - User can do the booking only for future dates and for the today date but for the future time only not the past time.

## Business Rules
1. When user booking the appointment, booking time must exactly match an available time slot.
2. When admin store the working time rules, it must not be overlap the previous timeslots he stored in the system for the same weekday.
3. Business logic for get the time slot availability is managed by the single Service class file to both availability and bookings api method logic to reused across APIs.


**Improvements**
1. Add admin authentication.
2. Add enable/disable toggle for working hour rules for Admin so he can Enable/Disable the timeslot.
3. Add Toggle API for Enable/Disable the services he(admin) added in the system.
4. Send respective email to the user for his booking confirmation using queue jobs.
5. Make API for user/admin both to cancel the appointment.
6. Make indexes in db columns for better performance and faster the queries.

## File Structure
appointment-booking-backend/

├── app/

│ ├── Http/

│ │ ├── Controllers/

│ │ │ └── Api/

│ │ │ ├── AvailabilityController.php

│ │ │ ├── BookingController.php

│ │ │ ├── AdminController.php

│ │ │ └── HomeController.php

│ │ ├── Requests/

│ │ │ ├── BookingRequest.php

│ │ │ └── StoreWorkingHoursRequest.php

│ │

│ ├── Models/

│ │ ├── Appointment.php

│ │ ├── Service.php

│ │ ├── Weekday.php

│ │ └── WorkingTimeRule.php

│ │

│ └── Services/

│ └── AvailabilityService.php

│

├── database/

│ ├── migrations/

│ └── seeders/

│ ├── ServiceSeeder.php

│ └── WeekdaySeeder.php

│

├── routes/

│ └── api.php

│

├── .env

├── composer.json

└── README.md

## Folder & File Responsibilities

### `app/Http/Controllers/Api`
Contains all API controllers.

- **AvailabilityController**
  - Calculates available time slots based on working hours, service duration, and existing bookings.

- **BookingController**
  - Handles appointment booking.
  - Validates slot availability, future time, and prevents overlaps.

- **AdminController**
  - Manages working hour rules (list & create).

- **HomeController**
  - Provides basic master data like services and weekdays.

---

### `app/Http/Requests`
Contains request validation logic.

- **BookingRequest**
  - Validates booking payload (date format, email, service).

- **StoreWorkingHoursRequest**
  - Validates admin working hour inputs and time rules.

---

### `app/Models`
Eloquent models representing database tables.

- **Service**
  - Service name, duration, and active status.

- **WorkingTimeRule**
  - Defines working hours for each weekday.

- **Weekday**
  - Master table for weekdays.

- **Appointment**
  - Stores booked appointments with status.

---

### `app/Services`
Contains reusable business logic.

- **AvailabilityService**
  - Single source of truth for availability calculation.
  - Used by both availability listing and booking validation.

---

### `database/migrations`
Defines database schema.

- Tables: services, working_time_rules, weekdays, appointments

---

### `database/seeders`
Initial data population.

- **ServiceSeeder**
  - Inserts default services.

- **WeekdaySeeder**
  - Inserts weekdays.

---

### `routes/api.php`
Defines all API routes for client and admin usage.
