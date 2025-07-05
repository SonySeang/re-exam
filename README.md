# Ecommerce Platform

A modern Laravel-based ecommerce platform that allows users to create shops, manage products, and explore marketplace offerings with role-based access control.

## Features

### 🏪 Multi-Shop Platform
- Users can request to become shop owners
- Admin approval system for shop owner requests
- Individual shop pages with custom branding and logos

### 📦 Product Management
- Full CRUD operations for products
- Image uploads and inventory tracking
- Advanced filtering by name and price range
- Shop-specific product management

### 👥 Role-Based Access Control
- **Admin**: Manage shop requests, view all shops and products
- **Shop Owner**: Create and manage their own shop and products
- **User**: Browse products, request shop owner status
- **Guest**: Explore products and shops without registration

### 🎨 Modern UI/UX
- Clean sidebar navigation for authenticated users
- Responsive design with Tailwind CSS
- Beautiful home page with feature showcase
- Product exploration with advanced filtering

## Tech Stack

- **Backend**: Laravel 11
- **Database**: PostgreSQL
- **Frontend**: Blade Templates + Tailwind CSS
- **Icons**: Font Awesome
- **Containerization**: Docker (PostgreSQL)

## Installation

### Prerequisites
- PHP 8.2+
- Composer
- Docker & Docker Compose
- Node.js (optional, for asset compilation)

### Step 1: Clone Repository
```bash
git clone <repository-url>
cd re-exam
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

### Step 4: Start PostgreSQL Database
```bash
docker-compose up -d
```

### Step 5: Run Migrations & Seeders
```bash
php artisan migrate
php artisan db:seed
```

### Step 6: Create Storage Link
```bash
php artisan storage:link
```

### Step 7: Start Development Server
```bash
php artisan serve
```

Visit `http://localhost:8000`

## Default Accounts

After running seeders, you can login with:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@example.com | password |
| Shop Owner | shop@example.com | password |
| Regular User | user@example.com | password |

## Database Schema

### Users Table
- `id`, `name`, `email`, `password`
- `role` (user, shop_owner, admin)
- `created_at`, `updated_at`

### Shop Owner Requests Table
- `id`, `user_id`, `business_name`, `description`
- `status` (pending, approved, rejected)
- `created_at`, `updated_at`

### Shops Table
- `id`, `user_id`, `name`, `description`, `logo`
- `created_at`, `updated_at`

### Products Table
- `id`, `shop_id`, `name`, `description`
- `price`, `image`, `stock`
- `created_at`, `updated_at`

## API Routes

### Public Routes
- `GET /` - Home page
- `GET /explore` - Browse all products
- `GET /shops` - Browse all shops
- `GET /shop/{id}` - View specific shop

### Authentication Routes
- `GET /login` - Login form
- `POST /login` - Process login
- `GET /register` - Registration form
- `POST /register` - Process registration
- `POST /logout` - Logout

### User Routes (Authenticated)
- `GET /dashboard` - User dashboard
- `POST /shop-owner-request` - Request shop owner status

### Admin Routes
- `GET /admin/shop-requests` - Manage shop requests
- `POST /admin/shop-requests/{id}/approve` - Approve request
- `POST /admin/shop-requests/{id}/reject` - Reject request
- `GET /admin/shops` - View all shops
- `GET /admin/products` - View all products

### Shop Owner Routes
- `GET /shop/dashboard` - Shop dashboard
- `GET /shop/create` - Create shop form
- `POST /shop` - Store shop
- `GET /shop/{id}/edit` - Edit shop
- `PUT /shop/{id}` - Update shop
- `GET /products` - Manage products
- `GET /products/create` - Add product form
- `POST /products` - Store product
- `GET /products/{id}/edit` - Edit product
- `PUT /products/{id}` - Update product
- `DELETE /products/{id}` - Delete product

## User Workflow

### For Regular Users
1. Register/Login
2. Browse products via "Explore" page
3. Visit individual shops
4. Request shop owner status from dashboard

### For Shop Owners
1. Create shop with logo and description
2. Add products with images and pricing
3. Manage inventory and product details
4. View shop analytics from dashboard

### For Admins
1. Review and approve/reject shop owner requests
2. Monitor all shops and products
3. Manage platform oversight

## File Structure

```
app/
├── Http/Controllers/
│   ├── AuthController.php
│   ├── ProductController.php
│   ├── ShopController.php
│   └── ShopOwnerRequestController.php
├── Http/Middleware/
│   ├── AdminMiddleware.php
│   └── ShopOwnerMiddleware.php
└── Models/
    ├── User.php
    ├── Shop.php
    ├── Product.php
    └── ShopOwnerRequest.php

resources/views/
├── layouts/app.blade.php
├── welcome.blade.php
├── dashboard.blade.php
├── auth/
├── admin/
├── shop/
├── products/
└── shops/

database/
├── migrations/
└── seeders/
```

## Configuration

### Database Configuration (.env)
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5433
DB_DATABASE=ecommerce_db
DB_USERNAME=postgres
DB_PASSWORD=password
```

### Docker Configuration (docker-compose.yml)
```yaml
services:
  postgres:
    image: postgres:15
    ports:
      - "5433:5432"
    environment:
      POSTGRES_DB: ecommerce_db
      POSTGRES_USER: postgres
      POSTGRES_PASSWORD: password
```

## Development Commands

```bash
# Reset database
php artisan migrate:fresh --seed

# Create new migration
php artisan make:migration create_table_name

# Create new controller
php artisan make:controller ControllerName

# Create new model
php artisan make:model ModelName

# Run specific seeder
php artisan db:seed --class=SeederName
```

## Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Ensure PostgreSQL container is running: `docker-compose ps`
   - Check database credentials in `.env`

2. **Storage Link Issues**
   - Run: `php artisan storage:link`
   - Check file permissions

3. **Migration Errors**
   - Reset database: `php artisan migrate:fresh`
   - Check migration files for syntax errors

4. **Seeder Issues**
   - Run specific seeder: `php artisan db:seed --class=AdminUserSeeder`
   - Check seeder class names and namespaces

## Contributing

1. Fork the repository
2. Create feature branch
3. Make changes
4. Submit pull request

## License

This project is open-sourced software licensed under the MIT license.