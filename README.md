<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Simple Appointment Booking System

A simple appointment booking API system built using **Laravel 10 (API)** and implemented in **Vue 3 (SPA)** ans tested using **Postman**.

This is a backend API system handles services, working hours, availability calculation, and appointment bookings.

# Tech Stack Pre Requisites.
*PHP v8.2*

*Laravel v10.**

*MySql v8.**

*Composer v2.9*

# Setup
You can clone this repository using the git clone.
 After clone, Run these commands one by one:

 ```composer install```

 ```cp .env.example .env```

 ```php artisan key:generate```

Now, Create a database named booking and update the database info into .env file by finding the below keys.

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
1. /api/availability - GET - User can check the available timeslots for the specific date(Date cannot be the past date).
2. /api/bookings - POST - User can do the booking only for future dates and for the today date but for the future time only not the past time.

**Rules:**
1. When user booking the appointment, Bookings time slot must match the available timeslot.
2. When admin store the working time rules, it must not be overlap the previous timeslots he stored in the system.
3. Business logic for get the time slot availability is managed by the single Service class file to both availability and bookings api method logic.



**Improvements**
1. I will be add Admin authentication
2. Add Toggle API for Working hours slot table for Admin so he can Enable/Disable the timeslot.
3. Add Toggle API for Enable/Disable the services he added in the system.
4. Send respective email to the user for his booking confirmation using queue jobs.
5. Make API for user/admin both to cancel the appointment. 

