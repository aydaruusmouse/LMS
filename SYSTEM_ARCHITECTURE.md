# FacultyLMS - Complete E-Learning Management System
## System Architecture Documentation

---

## Table of Contents
1. [System Overview](#system-overview)
2. [Technology Stack](#technology-stack)
3. [Architecture Patterns](#architecture-patterns)
4. [System Modules](#system-modules)
5. [Database Architecture](#database-architecture)
6. [API Architecture](#api-architecture)
7. [Frontend Architecture](#frontend-architecture)
8. [Security Architecture](#security-architecture)
9. [Payment Integration](#payment-integration)
10. [Deployment Architecture](#deployment-architecture)

---

## 1. System Overview

### 1.1 Purpose
FacultyLMS is a comprehensive e-learning management system designed to facilitate online education delivery, course management, student enrollment, instructor management, and organizational learning programs.

### 1.2 Key Features
- **Multi-tenant Architecture**: Supports organizations, instructors, and individual students
- **Course Management**: Complete course creation, content delivery, and progress tracking
- **Payment Processing**: Multiple payment gateway integrations
- **Mobile API**: RESTful API for mobile applications
- **Multi-language Support**: Internationalization and localization
- **Role-Based Access Control**: Granular permission system
- **Live Classes**: Real-time virtual classroom functionality
- **Assessment System**: Quizzes, assignments, and certificates
- **Communication**: Messaging, notifications, and support tickets

### 1.3 User Roles
1. **Super Admin**: System-wide administration
2. **Organization Admin**: Organization-level management
3. **Organization Staff**: Limited organization management
4. **Instructor**: Course creation and management
5. **Student**: Course enrollment and learning

---

## 2. Technology Stack

### 2.1 Backend Framework
- **Laravel 9.x** (PHP 8.0+)
- **PHP**: 8.0.2 or higher
- **Architecture**: MVC (Model-View-Controller)

### 2.2 Frontend Technologies
- **Blade Templating Engine**: Server-side rendering
- **Tailwind CSS 3.x**: Utility-first CSS framework
- **Alpine.js 3.x**: Lightweight JavaScript framework
- **Vue.js 3.x**: Progressive JavaScript framework (for interactive components)
- **Vite 4.x**: Build tool and development server

### 2.3 Database
- **MySQL/MariaDB**: Primary relational database
- **Redis**: Caching and session storage (via Predis)

### 2.4 Key Dependencies
- **Authentication**: Laravel Sanctum, JWT Auth
- **PDF Generation**: DomPDF
- **Excel Processing**: Maatwebsite Excel
- **Image Processing**: Intervention Image
- **DataTables**: Yajra DataTables
- **Notifications**: Pusher (WebSocket)
- **SMS**: Twilio, Nexmo
- **Email**: SMTP configuration

### 2.5 Payment Gateways
- PayPal, Stripe, Razorpay, Paytm
- SSL Commerz, Mollie, Paystack
- Flutterwave, MercadoPago, Midtrans
- Telr, Nagad, bKash, Skrill, Iyzico
- Kkiapay, Aamarpay, Hitpay
- And more...

---

## 3. Architecture Patterns

### 3.1 MVC Pattern
```
┌─────────────┐
│   Routes    │
└──────┬──────┘
       │
       ▼
┌─────────────┐
│ Controllers │
└──────┬──────┘
       │
       ├──────────┐
       ▼          ▼
┌──────────┐  ┌──────────┐
│ Models   │  │ Views    │
└──────────┘  └──────────┘
```

### 3.2 Repository Pattern
- **Purpose**: Abstraction layer between controllers and models
- **Location**: `app/Repositories/`
- **Benefits**: 
  - Separation of concerns
  - Easier testing
  - Centralized data access logic

### 3.3 Service Layer
- **Location**: `app/Services/`
- **Purpose**: Business logic separation
- **Structure**:
  - Admin/Dashboard services
  - Instructor/Dashboard services
  - Organization/Dashboard services

### 3.4 Trait Pattern
- **Location**: `app/Traits/`
- **Common Traits**:
  - `PaymentTrait`: Payment processing logic
  - `SendMailTrait`: Email sending functionality
  - `SendNotification`: Notification handling
  - `SmsSenderTrait`: SMS sending
  - `ImageTrait`: Image processing
  - `AccountingTrait`: Financial transactions
  - `ApiReturnFormatTrait`: API response formatting

### 3.5 Middleware Architecture
```
Request → Global Middleware → Route Middleware → Controller
```

**Global Middleware:**
- TrustProxies
- HandleCors
- PreventRequestsDuringMaintenance
- TrimStrings
- XssMiddleware

**Route Middleware:**
- Authentication (`auth`, `jwt.verify`)
- Authorization (`adminCheck`, `instructorCheck`, `studentCheck`)
- Permission checking (`PermissionCheck`)
- API key validation (`CheckApiKey`)
- XSS protection (`XSS`)

---

## 4. System Modules

### 4.1 Core Modules

#### 4.1.1 User Management
- **Controllers**: `UserController`, `ProfileController`
- **Models**: `User`, `Role`, `Permission`
- **Features**:
  - User registration and authentication
  - Role-based access control
  - Profile management
  - Email/Phone verification

#### 4.1.2 Course Management
- **Controllers**: `CourseController`, `LessonController`, `SectionController`
- **Models**: `Course`, `Lesson`, `Section`, `Resource`
- **Features**:
  - Course creation and editing
  - Section and lesson organization
  - Resource management
  - Course publishing workflow
  - Course types (video, live, text, etc.)

#### 4.1.3 Enrollment System
- **Controllers**: `EnrollmentController`
- **Models**: `Enroll`, `CourseProgress`
- **Features**:
  - Student enrollment
  - Progress tracking
  - Completion certificates
  - Enrollment history

#### 4.1.4 Payment & Checkout
- **Controllers**: `CartController`, `PurchaseController`, `PaymentController`
- **Models**: `Cart`, `Checkout`, `Transaction`, `Wallet`
- **Features**:
  - Shopping cart functionality
  - Multiple payment gateway support
  - Coupon system
  - Wallet management
  - Refund processing

### 4.2 Administrative Modules

#### 4.2.1 Admin Panel
- **Location**: `app/Http/Controllers/Admin/`
- **Key Controllers**:
  - `AdminController`: Dashboard and overview
  - `CourseController`: Course administration
  - `StudentController`: Student management
  - `InstructorController`: Instructor management
  - `OrganizationController`: Organization management
  - `ReportController`: Analytics and reports
  - `SystemSettingController`: System configuration

#### 4.2.2 Organization Module
- **Location**: `app/Http/Controllers/Organization/`
- **Features**:
  - Organization dashboard
  - Staff management
  - Course management for organization
  - Student management
  - Financial reporting
  - Payout management

#### 4.2.3 Instructor Module
- **Location**: `app/Http/Controllers/Instructor/`
- **Features**:
  - Instructor dashboard
  - Course creation and management
  - Student management
  - Assignment management
  - Live class scheduling
  - Quiz creation
  - Certificate generation
  - Earnings and payouts

### 4.3 Learning Features

#### 4.3.1 Assessment System
- **Models**: `Quiz`, `QuizQuestion`, `QuizAnswer`, `Assignment`, `SubmitedAssignment`
- **Features**:
  - Quiz creation and management
  - Multiple question types
  - Assignment submission
  - Grading system
  - Progress tracking

#### 4.3.2 Live Classes
- **Model**: `LiveClass`, `Meeting`
- **Features**:
  - Live class scheduling
  - Virtual meeting integration
  - Attendance tracking
  - Recording management

#### 4.3.3 Certificates
- **Model**: `Certificate`
- **Features**:
  - Certificate generation
  - Template management
  - PDF generation
  - Verification system

### 4.4 Communication Modules

#### 4.4.1 Messaging System
- **Models**: `ChatRoom`, `Message`
- **Features**:
  - Real-time messaging
  - Chat rooms
  - File sharing

#### 4.4.2 Notification System
- **Model**: `Notification`, `CustomNotification`
- **Features**:
  - In-app notifications
  - Email notifications
  - SMS notifications
  - Push notifications (via Pusher)

#### 4.4.3 Support System
- **Models**: `Ticket`, `TicketReply`, `Department`
- **Features**:
  - Ticket creation and management
  - Department assignment
  - Reply system
  - Status tracking

### 4.5 Content Management

#### 4.5.1 Blog System
- **Models**: `Blog`, `BlogCategory`, `BlogComment`
- **Features**:
  - Blog post management
  - Category organization
  - Comment system
  - SEO optimization

#### 4.5.2 Media Library
- **Model**: `MediaLibrary`
- **Features**:
  - File upload and management
  - Image processing
  - Cloud storage support (AWS S3)
  - Media organization

### 4.6 E-commerce Features

#### 4.6.1 Shopping Cart
- **Model**: `Cart`
- **Features**:
  - Add/remove items
  - Quantity management
  - Session-based storage

#### 4.6.2 Coupon System
- **Models**: `Coupon`, `AppliedCoupon`
- **Features**:
  - Discount creation
  - Percentage/fixed discounts
  - Usage limits
  - Expiration dates

#### 4.6.3 Wishlist
- **Model**: `Wishlist`
- **Features**:
  - Save courses for later
  - Quick purchase

### 4.7 Financial Management

#### 4.7.1 Accounting System
- **Models**: `Account`, `AccountingTransaction`, `Transaction`
- **Features**:
  - Financial tracking
  - Revenue management
  - Expense tracking
  - Financial reports

#### 4.7.2 Payout System
- **Models**: `Payout`, `InstructorPayoutMethod`, `OrganizationPayoutMethod`
- **Features**:
  - Instructor/organization payouts
  - Payment method management
  - Payout history
  - Commission calculation

#### 4.7.3 Wallet System
- **Model**: `Wallet`
- **Features**:
  - User wallet balance
  - Deposit/withdrawal
  - Transaction history

---

## 5. Database Architecture

### 5.1 Database Structure

#### 5.1.1 Core Tables
- `users`: User accounts and authentication
- `roles`: Role definitions
- `permissions`: Permission definitions
- `settings`: System configuration
- `languages`: Language support
- `currencies`: Currency management

#### 5.1.2 Course-Related Tables
- `courses`: Course information
- `sections`: Course sections
- `lessons`: Individual lessons
- `resources`: Course resources
- `enrolls`: Student enrollments
- `course_progress`: Learning progress
- `ratings`: Course ratings
- `comments`: Course comments

#### 5.1.3 User Management Tables
- `instructors`: Instructor profiles
- `organizations`: Organization information
- `organization_staff`: Organization staff members
- `addresses`: User addresses
- `social_accounts`: Social login accounts

#### 5.1.4 Payment Tables
- `carts`: Shopping carts
- `checkouts`: Purchase transactions
- `transactions`: Financial transactions
- `wallets`: User wallets
- `coupons`: Discount coupons
- `applied_coupons`: Coupon usage
- `payouts`: Payout records
- `refunds`: Refund records

#### 5.1.5 Assessment Tables
- `quizzes`: Quiz definitions
- `quiz_questions`: Quiz questions
- `quiz_answers`: Student answers
- `assignments`: Assignment definitions
- `submited_assignments`: Submitted work

#### 5.1.6 Communication Tables
- `notifications`: System notifications
- `custom_notifications`: Custom notifications
- `tickets`: Support tickets
- `ticket_replies`: Ticket responses
- `chat_rooms`: Chat rooms
- `messages`: Chat messages

#### 5.1.7 Content Tables
- `blogs`: Blog posts
- `blog_categories`: Blog categories
- `blog_comments`: Blog comments
- `media_libraries`: Media files
- `pages`: Static pages
- `sliders`: Homepage sliders

### 5.2 Multi-language Support
- Language-specific tables use suffix `_languages`
- Examples: `blog_languages`, `course_languages`, `category_languages`
- Centralized language configuration in `language_configs` table

### 5.3 Relationships
- **One-to-Many**: Course → Sections → Lessons
- **Many-to-Many**: Courses ↔ Instructors, Courses ↔ Students (via enrolls)
- **Polymorphic**: Ratings, Comments (can rate/comment on multiple entity types)

---

## 6. API Architecture

### 6.1 API Structure

#### 6.1.1 Student API
- **Base Path**: `/api/`
- **Authentication**: JWT Token
- **Middleware**: `CheckApiKey`, `jwt.verify`
- **Controllers**: `app/Http/Controllers/Api/Student/`
- **Endpoints**:
  - Authentication (login, register, verify)
  - Courses (list, details, enrollment)
  - Cart and checkout
  - Assignments and quizzes
  - Certificates
  - Live classes
  - Notifications
  - Wishlist

#### 6.1.2 Instructor API
- **Base Path**: `/api/instructor/`
- **Authentication**: JWT Token
- **Controllers**: `app/Http/Controllers/Api/Instructor/`
- **Endpoints**:
  - Course management
  - Student management
  - Analytics
  - Earnings

### 6.2 API Response Format
- **Standardized responses** via `ApiReturnFormatTrait`
- **Structure**:
  ```json
  {
    "success": true/false,
    "message": "Response message",
    "data": {},
    "errors": []
  }
  ```

### 6.3 API Security
- **API Key Validation**: `CheckApiKeyMiddleware`
- **JWT Authentication**: Token-based authentication
- **Rate Limiting**: 60 requests per minute
- **CORS**: Configured for cross-origin requests

---

## 7. Frontend Architecture

### 7.1 View Structure
```
resources/views/
├── frontend/          # Public-facing pages
├── admin/            # Admin panel views
├── instructor/       # Instructor panel views
├── organization/     # Organization panel views
├── auth/             # Authentication views
└── layouts/          # Layout templates
```

### 7.2 Blade Components
- **Layouts**: Master templates with header, footer, sidebar
- **Components**: Reusable UI components
- **Partials**: Shared view fragments

### 7.3 Frontend Assets
- **CSS**: Tailwind CSS (compiled via Vite)
- **JavaScript**: Alpine.js, Vue.js (compiled via Vite)
- **Build Tool**: Vite 4.x
- **Asset Location**: `public/` directory

### 7.4 Localization
- **Language Files**: `lang/` directory (JSON format)
- **Route Prefixing**: `localeRoutePrefix()` helper
- **Multi-language Views**: Language-specific content loading

---

## 8. Security Architecture

### 8.1 Authentication
- **Web**: Laravel's built-in authentication
- **API**: JWT (php-open-source-saver/jwt-auth)
- **Social Login**: OAuth integration
- **Two-Factor**: Email/Phone verification

### 8.2 Authorization
- **Role-Based Access Control (RBAC)**
- **Permission System**: Granular permissions per role
- **Middleware Protection**: Route-level authorization
- **Policy-Based**: Laravel policies for resource authorization

### 8.3 Security Features
- **XSS Protection**: `XssMiddleware` for input sanitization
- **CSRF Protection**: Laravel's CSRF token validation
- **SQL Injection**: Eloquent ORM protection
- **Password Hashing**: Bcrypt/Argon2
- **Rate Limiting**: API and route throttling
- **Input Validation**: Form request validation

### 8.4 Data Protection
- **Encryption**: Laravel's encryption services
- **Secure Sessions**: Encrypted session storage
- **HTTPS**: SSL/TLS support
- **Data Sanitization**: Input cleaning and validation

---

## 9. Payment Integration

### 9.1 Supported Payment Gateways
1. **International**:
   - PayPal
   - Stripe
   - Razorpay
   - Mollie
   - Paystack
   - Flutterwave
   - MercadoPago
   - Midtrans
   - Skrill
   - Iyzico

2. **Regional**:
   - Paytm (India)
   - SSL Commerz (Bangladesh)
   - Nagad (Bangladesh)
   - bKash (Bangladesh)
   - Telr (Middle East)
   - Kkiapay (Africa)
   - Aamarpay (Bangladesh)
   - Hitpay (Singapore)

### 9.2 Payment Flow
```
Cart → Checkout → Payment Gateway → Callback → Transaction Record → Enrollment
```

### 9.3 Payment Processing
- **Trait**: `PaymentTrait` handles all payment methods
- **Transaction Tracking**: All payments logged in `transactions` table
- **Refund Support**: Refund processing system
- **Wallet Integration**: Internal wallet for payments

### 9.4 Offline Payment Methods
- **Model**: `OfflineMethod`
- **Features**: Manual payment method configuration
- **Verification**: Admin approval workflow

---

## 10. Deployment Architecture

### 10.1 Server Requirements
- **PHP**: 8.0.2 or higher
- **Database**: MySQL 5.7+ / MariaDB 10.3+
- **Web Server**: Apache 2.4+ / Nginx 1.18+
- **Extensions**: 
  - curl
  - zip
  - gd
  - mbstring
  - openssl
  - pdo_mysql

### 10.2 File Structure
```
/
├── app/              # Application code
├── bootstrap/        # Bootstrap files
├── config/           # Configuration files
├── database/         # Migrations and seeders
├── public/           # Public assets (web root)
├── resources/        # Views and assets
├── routes/           # Route definitions
├── storage/          # Logs, cache, uploads
└── vendor/           # Composer dependencies
```

### 10.3 Environment Configuration
- **`.env`**: Environment variables
- **Key Settings**:
  - Database connection
  - Mail configuration
  - Payment gateway credentials
  - AWS S3 (if used)
  - Pusher credentials
  - SMS gateway settings

### 10.4 Caching Strategy
- **Route Caching**: `php artisan route:cache`
- **Config Caching**: `php artisan config:cache`
- **View Caching**: `php artisan view:cache`
- **Redis**: Session and cache storage

### 10.5 Storage
- **Local Storage**: `storage/app/public`
- **Cloud Storage**: AWS S3 support
- **Media Files**: Organized in `media_libraries` table

### 10.6 Queue System
- **Queue Driver**: Database/Redis
- **Background Jobs**: Email sending, notifications
- **Command**: `php artisan queue:work`

---

## 11. Addon System

### 11.1 Addon Architecture
- **Location**: `app/Addons/`
- **Manager**: `AddonManager` class
- **Purpose**: Extensible plugin system
- **Features**:
  - Dynamic addon loading
  - Service provider integration
  - Route registration
  - View integration

---

## 12. Reporting & Analytics

### 12.1 Dashboard Analytics
- **Admin Dashboard**: System-wide statistics
- **Instructor Dashboard**: Course performance
- **Organization Dashboard**: Organization metrics
- **Student Dashboard**: Learning progress

### 12.2 Report Types
- **Sales Reports**: Revenue and transactions
- **Enrollment Reports**: Student enrollment statistics
- **Course Reports**: Course performance metrics
- **Commission Reports**: Instructor/organization earnings
- **Payout Reports**: Payment history

### 12.3 Data Export
- **Excel Export**: Maatwebsite Excel
- **PDF Reports**: DomPDF
- **CSV Export**: Standard data export

---

## 13. Integration Points

### 13.1 Third-Party Services
- **Email**: SMTP configuration
- **SMS**: Twilio, Nexmo
- **Push Notifications**: Pusher
- **Storage**: AWS S3
- **Payment**: Multiple gateways
- **Social Login**: OAuth providers

### 13.2 API Integrations
- **RESTful API**: Mobile app support
- **Webhook Support**: Payment callbacks
- **OAuth**: Social authentication

---

## 14. Performance Optimization

### 14.1 Caching
- **Application Cache**: Redis/Database
- **Route Caching**: Compiled routes
- **View Caching**: Compiled Blade templates
- **Config Caching**: Compiled configuration

### 14.2 Database Optimization
- **Indexing**: Key fields indexed
- **Query Optimization**: Eager loading (with())
- **Connection Pooling**: Database connection management

### 14.3 Asset Optimization
- **Vite Build**: Optimized asset bundling
- **Minification**: CSS/JS minification
- **CDN Support**: Static asset delivery

---

## 15. Maintenance & Monitoring

### 15.1 Logging
- **Location**: `storage/logs/`
- **Log Levels**: Error, Warning, Info, Debug
- **Activity Logs**: User action tracking

### 15.2 Error Handling
- **Exception Handler**: `app/Exceptions/Handler.php`
- **Error Pages**: Custom error views
- **Debug Mode**: Development vs Production

### 15.3 Backup Strategy
- **Database Backups**: Regular database dumps
- **File Backups**: Media and upload files
- **Configuration Backups**: Settings and environment

---

## Conclusion

This architecture document provides a comprehensive overview of the FacultyLMS e-learning management system. The system is built on Laravel 9.x with a modular architecture, supporting multiple user roles, extensive payment integrations, and a robust API for mobile applications.

The system follows industry best practices including:
- MVC architecture
- Repository pattern
- Service layer separation
- RESTful API design
- Security best practices
- Scalable database design

For detailed implementation, refer to the source code in the respective directories mentioned in this document.

---

**Document Version**: 1.0  
**Last Updated**: 2024  
**System Version**: V160

