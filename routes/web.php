<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| AH-Vision Web Routes
|--------------------------------------------------------------------------
|
| This file contains the main web routes for the AH-Vision application.
| Routes are organized into separate files for better maintainability
| and structure. Each route group handles specific functionality.
|
| Route Organization:
| - User Routes: Public browsing, authentication, cart, MLM
| - Payment Routes: E-commerce and MLM payment processing
| - Admin Routes: Administrative functions and management
|
*/

// ========================================
// USER ROUTES
// ========================================

// Public User Routes (Product browsing, pages, etc.)
require __DIR__.'/user/public.php';

// Shopping Cart & Wishlist Routes
require __DIR__.'/user/cart.php';

// MLM (Multi-Level Marketing) Routes
require __DIR__.'/user/mlm.php';

// User Authentication & Profile Routes
require __DIR__.'/user/auth.php';

// ========================================
// PAYMENT ROUTES
// ========================================

// E-commerce Payment Processing
require __DIR__.'/payments/ecommerce.php';

// MLM Payment Processing
require __DIR__.'/payments/mlm.php';

// ========================================
// ADMIN ROUTES
// ========================================

// Admin Authentication & Profile
require __DIR__.'/admin/auth.php';

// User & Customer Management
require __DIR__.'/admin/users.php';

// Product Management
require __DIR__.'/admin/products.php';

// Order & Transaction Management
require __DIR__.'/admin/orders.php';

// System Settings & Configuration
require __DIR__.'/admin/settings.php';

// Content Management (Pages, FAQs, Tickets)
require __DIR__.'/admin/content.php';

// ========================================
// LARAVEL AUTHENTICATION ROUTES
// ========================================

// Include Laravel's default authentication routes
require __DIR__.'/auth.php';
