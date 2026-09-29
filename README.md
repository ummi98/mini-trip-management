# Mini Trip Management System

A Mini Trip Management System developed using Laravel, MySQL, and Git as part of a System Developer Technical Assessment.

The system provides role-based access for Admin, Staff, and Customer users. Customers can browse available trips, create bookings, register participants, and view their booking and payment status. Admin and Staff users can manage trips and customer bookings.

## Technology Stack

- Laravel 13
- PHP
- MySQL
- Blade
- Tailwind CSS
- Git
- GitHub

## Core Features

- User authentication
- Role-based access: Admin, Staff, Customer
- Trip CRUD
- Customer trip listing
- Trip details
- Customer booking
- Participant registration
- Trip and participant relationships
- Search and filtering
- Form validation
- Booking management
- Payment status management

## Customer Booking Flow

The main customer flow is:

Customer Login → View Trips → View Trip Details → Select Trip → Create Booking → Register Participant → View Booking Status

Customers are able to:

- Login to the system
- View available trips
- View trip details
- Select and book a trip
- Register participant information
- View their own bookings
- View booking status
- View payment status

## Admin / Staff Flow

Admin and Staff users are able to:

- Login to the system
- Access the dashboard
- Create, view, update, and delete trips
- View customer bookings
- View booking details
- Manage booking status
- Manage payment status

## Additional Features

The system also includes:

- Simple dashboard
- Payment status management
- Trip capacity management
- Participant count and remaining seat management
- Prevention of booking/participant registration when trip capacity is full

## Bonus Features

Where implemented, the system also includes:

- Duplicate participant registration prevention
- Passport expiry validation
- Warning when passport validity is less than six months from the trip date

## Installation

### 1. Clone Repository

```bash
git clone git@github.com:ummi98/mini-trip-management.git
cd mini-trip-management
```

Alternatively, the repository can be cloned using HTTPS.

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Frontend Dependencies

```bash
npm install
npm run build
```

### 4. Environment Setup

Copy the example environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure the MySQL database connection in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=mini_trip_management
DB_USERNAME=root
DB_PASSWORD=
```

Update the username and password according to the local MySQL configuration.

### 5. Create Database

Create a MySQL database:

```sql
CREATE DATABASE mini_trip_management;
```

### 6. Run Migrations and Seeders

```bash
php artisan migrate --seed
```

### 7. Storage Link

```bash
php artisan storage:link
```

### 8. Run Application

```bash
php artisan serve
```

Then access the application through the local URL displayed in the terminal.

## Test Login Credentials

### Admin

Email: `admin@test.com`  
Password: `password`

### Staff

Email: `staff@test.com`  
Password: `password`

### Customer

Email: `customer@test.com`  
Password: `password`

## User Roles

| Role | Access |
|---|---|
| Admin | Dashboard, Trip Management, Booking Management |
| Staff | Dashboard, Trip Management, Booking Management |
| Customer | Browse Trips, Create Booking, Register Participants, View Own Bookings |

## Main Database Relationships

The application uses relationships between the main entities:

- User → Bookings
- Trip → Bookings
- Booking → Trip
- Booking → Customer/User
- Booking → Participants
- Participant → Booking
- Participant → Trip through Booking

This structure allows a customer booking to contain one or more participants while keeping the booking associated with a specific trip.

## Trip Capacity Management

Each trip can have a maximum capacity.

The system checks the number of registered participants against the trip capacity and prevents additional registration when the trip is full.

The system also displays participant and remaining seat information where applicable.

## Passport Expiry Validation

Participant passport expiry dates can be compared against the trip date.

A warning is displayed when the passport validity is less than six months from the trip date.

## Validation

Server-side Laravel validation is used for important forms, including:

- Trip creation and update
- Booking
- Participant registration
- Passport information

Validation errors are displayed to the user when submitted information is invalid.

## Completed Features

- Login and authentication
- Admin / Staff / Customer roles
- Role-based route protection
- Trip CRUD
- Customer trip listing
- Trip details
- Customer booking flow
- Participant registration
- Booking and participant relationships
- Customer booking history
- Booking status
- Payment status
- Admin / Staff booking management
- Search / filtering
- Form validation
- Simple dashboard
- Trip capacity management
- Database migrations and seeders
- Git version control

## Incomplete / Future Improvements

The following areas may be further enhanced:

- More detailed activity/status history
- Extended automated testing
- UI/UX improvements
- Additional reporting features

## Repository

GitHub Repository:

`https://github.com/ummi98/mini-trip-management`

## Technical Assessment

This project was developed as a Mini Trip Management System technical assessment with priority given to:

1. Requirement understanding
2. Database design
3. Laravel code structure
4. Core customer booking flow
5. Validation
6. Role-based access
7. Testing and debugging
8. Git version control
9. Project documentation and delivery