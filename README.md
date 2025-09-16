
# 🚀 AH-Vision - Advanced E-commerce & MLM Platform

[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Demo](https://img.shields.io/badge/Demo-Live-brightgreen.svg)](https://ahknoxo.com/)

**AH-Vision** is a comprehensive web application that seamlessly combines **E-commerce** functionality with **Multi-Level Marketing (MLM)** capabilities. Built with Laravel 10, it provides a robust platform for businesses looking to implement both traditional e-commerce and network marketing strategies.

## 📋 Table of Contents

- [🌟 Key Features](#-key-features)
- [🛠️ Technology Stack](#️-technology-stack)
- [💳 Payment Gateways](#-payment-gateways)
- [📦 External Packages](#-external-packages)
- [⚡ Quick Start](#-quick-start)
- [🔧 Installation Guide](#-installation-guide)
- [⚙️ Configuration](#️-configuration)
- [🎯 Feature Overview](#-feature-overview)
- [👥 User Roles & Permissions](#-user-roles--permissions)
- [💰 MLM System](#-mlm-system)
- [🛒 E-commerce Features](#-e-commerce-features)
- [📊 Admin Panel](#-admin-panel)
- [🔐 Security Features](#-security-features)
- [📱 API Documentation](#-api-documentation)
- [🧪 Testing](#-testing)
- [🚀 Deployment](#-deployment)
- [🤝 Contributing](#-contributing)
- [📄 License](#-license)

## 🌟 Key Features

### 🛒 **E-commerce Core**
- **Product Management**: Physical, Digital, and Customizable products
- **Advanced Cart System**: Session-based cart with wishlist functionality
- **Multi-Payment Gateway**: Support for 5+ payment methods
- **Order Management**: Complete order lifecycle with tracking
- **Inventory Management**: Real-time stock tracking
- **Review & Rating System**: Customer feedback and ratings
- **Coupon System**: Discount codes and promotional offers
- **Shipping Management**: Multiple shipping options and zones

### 🌐 **MLM (Multi-Level Marketing)**
- **Hierarchical Structure**: Parent-child referral system
- **Commission Tracking**: Automated commission calculations
- **Digital Product Sales**: MLM-specific product offerings
- **Referral Links**: Unique referral codes for each user
- **Team Management**: View and manage downline members
- **Activation System**: Admin and parent activation controls
- **Earnings Dashboard**: Real-time earnings and statistics

### 🎛️ **Admin Panel**
- **Comprehensive Dashboard**: Analytics and key metrics
- **User Management**: Customer and MLM user administration
- **Product Management**: CRUD operations with bulk import/export
- **Order Processing**: Order status management and fulfillment
- **Payment Gateway Config**: Dynamic payment method setup
- **Email Configuration**: SMTP settings and templates
- **Site Settings**: Logo, favicon, meta tags, and more
- **Role & Permission System**: Granular access control

### 🔧 **Advanced Features**
- **Ticket System**: Customer support and issue tracking
- **Social Media Integration**: Facebook and Google OAuth
- **Email Marketing**: Newsletter and subscriber management
- **SEO Optimization**: Meta tags and search-friendly URLs
- **Multi-language Support**: Localization ready
- **Cookie Consent**: GDPR compliance
- **Real-time Notifications**: Admin and user notifications
- **Currency Converter**: Multi-currency support

## 🛠️ Technology Stack

### **Backend**
- **Framework**: Laravel 10.x
- **Language**: PHP 8.1+
- **Database**: MySQL 8.0+
- **Cache**: Redis (optional)
- **Queue**: Database/Redis
- **Storage**: Local/S3 compatible

### **Frontend**
- **CSS Framework**: TailwindCSS 3.x
- **JavaScript**: Alpine.js, Axios
- **Build Tool**: Vite
- **Icons**: Font Awesome
- **Plugins**: jQuery, Slick Carousel

### **Development Tools**
- **Testing**: Pest PHP
- **Code Quality**: Laravel Pint
- **API Documentation**: Built-in
- **Debugging**: Laravel Telescope (optional)

## 💳 Payment Gateways

AH-Vision supports multiple payment gateways for global reach:

| Gateway | Type | Currencies | Region |
|---------|------|------------|--------|
| **bKash** | Mobile Banking | BDT | Bangladesh |
| **SSL Commerz** | Payment Gateway | BDT, USD | Bangladesh |
| **PayPal** | Digital Wallet | USD, EUR, GBP+ | Global |
| **Stripe** | Credit/Debit Cards | 135+ Currencies | Global |
| **Cash on Delivery** | Manual | Any | Local |

### **Payment Features**
- **Dynamic Configuration**: Admin can configure payment methods
- **Currency Conversion**: Automatic currency conversion using QubitBD API
- **Secure Processing**: PCI DSS compliant payment handling
- **Transaction Tracking**: Complete payment audit trail
- **Refund Support**: Automated and manual refund processing

## 📦 External Packages

### **Core Packages**
```json
{
  "barryvdh/laravel-dompdf": "^2.0",           // PDF generation
  "coderflex/laravel-ticket": "^1.5",         // Support ticket system
  "darryldecode/cart": "^4.2",                // Shopping cart
  "karim007/laravel-bkash-tokenize": "^2.2",  // bKash payment
  "karim007/sslcommerz-laravel": "^2.2",      // SSL Commerz payment
  "lamalama/laravel-wishlist": "^0.2.1",      // Wishlist functionality
  "laravel/sanctum": "^3.2",                  // API authentication
  "laravel/socialite": "^5.12",               // Social login
  "maatwebsite/excel": "^3.1",                // Excel import/export
  "spatie/laravel-permission": "^6.7",        // Role & permissions
  "srmklive/paypal": "^3.0",                  // PayPal integration
  "statikbe/laravel-cookie-consent": "^1.8",  // Cookie consent
  "stripe/stripe-php": "^14.4"                // Stripe payment
}
```

### **Development Packages**
```json
{
  "laravel/breeze": "^1.21",                  // Authentication scaffolding
  "pestphp/pest": "^2.0",                     // Testing framework
  "laravel/pint": "^1.0",                     // Code formatting
  "spatie/laravel-ignition": "^2.0"           // Error page
}
```

## ⚡ Quick Start

### **Prerequisites**
- PHP 8.1 or higher
- Composer 2.x
- Node.js 16+ & NPM
- MySQL 8.0+
- Git

### **1-Minute Setup**
```bash
# Clone the repository
git clone https://github.com/Shareiar-shams/AH-Vision.git
cd AH-Vision

# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database setup
php artisan migrate --seed

# Build assets
npm run build

# Start development server
php artisan serve
```

**Default Admin Credentials:**
- Email: `admin@ahvision.com`
- Password: `password`

## 🔧 Installation Guide

### **Step 1: Clone Repository**
```bash
git clone https://github.com/Shareiar-shams/AH-Vision.git
cd AH-Vision
```

### **Step 2: Install Dependencies**
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### **Step 3: Environment Configuration**
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### **Step 4: Database Setup**
```bash
# Create database (MySQL)
mysql -u root -p
CREATE DATABASE ah_vision;
exit

# Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ah_vision
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Run migrations and seeders
php artisan migrate --seed
```

### **Step 5: Storage & Permissions**
```bash
# Create storage link
php artisan storage:link

# Set permissions (Linux/Mac)
chmod -R 775 storage bootstrap/cache
```

### **Step 6: Build Assets**
```bash
# Development build
npm run dev

# Production build
npm run build
```

### **Step 7: Start Application**
```bash
# Development server
php artisan serve

# Visit: http://localhost:8000
```

## ⚙️ Configuration

### **Payment Gateway Setup**

#### **bKash Configuration**
```env
BKASH_SANDBOX=true
BKASH_APP_KEY=your_app_key
BKASH_APP_SECRET=your_app_secret
BKASH_USERNAME=your_username
BKASH_PASSWORD=your_password
BKASH_CALLBACK_URL=http://localhost:8000/bkash/callback
```

#### **SSL Commerz Configuration**
```env
SSLCOMMERZ_SANDBOX=true
SSLCOMMERZ_STORE_ID=your_store_id
SSLCOMMERZ_STORE_PASSWORD=your_store_password
```

#### **PayPal Configuration**
```env
PAYPAL_MODE=sandbox
PAYPAL_SANDBOX_CLIENT_ID=your_client_id
PAYPAL_SANDBOX_CLIENT_SECRET=your_client_secret
PAYPAL_CURRENCY=USD
```

#### **Stripe Configuration**
```env
STRIPE_KEY=pk_test_your_publishable_key
STRIPE_SECRET=sk_test_your_secret_key
```

### **Social Media Login**
```env
# Facebook OAuth
FACEBOOK_CLIENT_ID=your_facebook_app_id
FACEBOOK_CLIENT_SECRET=your_facebook_app_secret
FACEBOOK_REDIRECT_URL=http://localhost:8000/auth/facebook/callback

# Google OAuth
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URL=http://localhost:8000/auth/google/callback
```

### **Email Configuration**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@gmail.com
MAIL_FROM_NAME="AH-Vision"
```

### **Currency Converter API**
```env
CURRENCY_API_USERNAME=shareiar
CURRENCY_API_KEY=30fc3c19229636efe51c66d5053e4149
```

## 🎯 Feature Overview

### **🛒 E-commerce Features**

#### **Product Management**
- **Product Types**: Physical, Digital, Affiliate, Customizable
- **Categories & Subcategories**: Hierarchical organization
- **Attributes & Options**: Size, color, material variations
- **Image Gallery**: Multiple product images
- **SEO Optimization**: Meta tags, descriptions, keywords
- **Stock Management**: Real-time inventory tracking
- **Pricing**: Regular and special pricing
- **Bulk Operations**: Import/Export via Excel

#### **Shopping Cart & Checkout**
- **Session-based Cart**: Persistent across browser sessions
- **Wishlist**: Save items for later
- **Coupon System**: Percentage and fixed discounts
- **Shipping Options**: Multiple shipping methods and zones
- **Tax Calculation**: Configurable tax rates
- **Guest Checkout**: Purchase without registration
- **Order Tracking**: Real-time order status updates

#### **Payment Processing**
- **Multiple Gateways**: 5+ payment options
- **Secure Processing**: PCI DSS compliant
- **Currency Conversion**: Real-time exchange rates
- **Payment Verification**: Automated verification
- **Refund Management**: Full and partial refunds

### **🌐 MLM System Features**

#### **Network Structure**
- **Binary/Unilevel Structure**: Flexible MLM compensation plans
- **Referral System**: Unique referral codes for each user
- **Parent-Child Hierarchy**: Multi-level user relationships
- **Activation System**: Admin and parent approval process
- **Commission Tracking**: Real-time commission calculations
- **Genealogy Tree**: Visual representation of downlines

#### **Digital Products for MLM**
- **MLM-specific Products**: Digital courses, tools, memberships
- **Instant Delivery**: Automated product delivery
- **Access Control**: Time-based or lifetime access
- **Product Activation**: Link products to MLM membership

#### **Earnings & Reports**
- **Commission Dashboard**: Real-time earnings overview
- **Sales Reports**: Daily, weekly, monthly statistics
- **Team Performance**: Downline activity and performance
- **Payout Management**: Commission distribution system
- **Rank Advancement**: Achievement-based ranking system

### **👥 User Management**

#### **User Roles**
- **Super Admin**: Full system access
- **Admin**: Administrative functions
- **MLM User**: Network marketing participants
- **Customer**: E-commerce shoppers
- **Guest**: Unregistered visitors

#### **Permission System**
- **Granular Permissions**: 50+ specific permissions
- **Role-based Access**: Assign permissions to roles
- **Dynamic Permissions**: Runtime permission checking
- **Resource Protection**: Controller and route-level security

### **📊 Admin Panel Features**

#### **Dashboard Analytics**
- **Sales Metrics**: Revenue, orders, conversion rates
- **User Statistics**: Registration, activity, demographics
- **Product Performance**: Best sellers, stock alerts
- **MLM Analytics**: Network growth, commission payouts
- **Financial Reports**: Profit/loss, payment gateway stats

#### **Content Management**
- **Page Builder**: Dynamic page creation
- **Menu Management**: Customizable navigation
- **Slider Management**: Homepage banners and promotions
- **FAQ System**: Categorized help content
- **Blog System**: Content marketing capabilities

#### **System Configuration**
- **Site Settings**: Logo, favicon, meta information
- **Payment Gateways**: Dynamic gateway configuration
- **Email Templates**: Customizable email notifications
- **Social Media**: OAuth provider settings
- **Cookie Consent**: GDPR compliance settings

### **🔐 Security Features**

#### **Authentication & Authorization**
- **Multi-guard Authentication**: Separate admin/user authentication
- **Social Login**: Facebook, Google OAuth integration
- **Email Verification**: Account activation via email
- **Password Reset**: Secure password recovery
- **Session Management**: Secure session handling

#### **Data Protection**
- **Input Validation**: Comprehensive form validation
- **CSRF Protection**: Cross-site request forgery prevention
- **XSS Protection**: Cross-site scripting prevention
- **SQL Injection Prevention**: Parameterized queries
- **File Upload Security**: Type and size validation

#### **Privacy & Compliance**
- **Cookie Consent**: GDPR-compliant cookie management
- **Data Encryption**: Sensitive data encryption
- **Audit Trails**: User activity logging
- **Privacy Controls**: User data management options

## 🚀 Usage Guide

### **For New Users**

#### **Customer Registration & Shopping**
1. **Registration**: Visit `/register` to create an account
2. **Browse Products**: Explore categories and products
3. **Add to Cart**: Select products and add to shopping cart
4. **Checkout**: Complete purchase with preferred payment method
5. **Track Orders**: Monitor order status in user dashboard

#### **MLM User Journey**
1. **Purchase MLM Product**: Buy a digital product to join MLM
2. **Get Referral Link**: Receive unique referral code
3. **Invite Others**: Share referral link with prospects
4. **Earn Commissions**: Get paid for successful referrals
5. **Build Team**: Grow your network and increase earnings

### **For Administrators**

#### **Initial Setup**
1. **Login**: Access admin panel at `/admin/login`
2. **Configure Site**: Set logo, favicon, site information
3. **Setup Payments**: Configure payment gateways
4. **Add Products**: Create product catalog
5. **Manage Users**: Handle user registrations and permissions

#### **Daily Operations**
1. **Process Orders**: Review and fulfill customer orders
2. **Manage Inventory**: Update stock levels and pricing
3. **Handle Support**: Respond to customer tickets
4. **Review Analytics**: Monitor sales and performance metrics
5. **MLM Management**: Approve MLM users and manage commissions

### **API Usage**

#### **Authentication**
```php
// Get API token
POST /api/login
{
    "email": "user@example.com",
    "password": "password"
}

// Use token in headers
Authorization: Bearer {token}
```

#### **Product API**
```php
// Get products
GET /api/products

// Get single product
GET /api/products/{id}

// Search products
GET /api/products/search?q=keyword
```

#### **Cart API**
```php
// Add to cart
POST /api/cart
{
    "product_id": 1,
    "quantity": 2
}

// Get cart contents
GET /api/cart

// Update cart item
PUT /api/cart/{id}
{
    "quantity": 3
}
```

## 🧪 Testing

### **Run Tests**
```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature

# Run with coverage
php artisan test --coverage
```

### **Test Categories**
- **Unit Tests**: Model and service testing
- **Feature Tests**: HTTP request testing
- **Browser Tests**: End-to-end testing
- **API Tests**: API endpoint testing

## 🚀 Deployment

### **Production Setup**

#### **Server Requirements**
- **PHP**: 8.1+ with extensions (BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML)
- **Web Server**: Apache 2.4+ or Nginx 1.18+
- **Database**: MySQL 8.0+ or PostgreSQL 13+
- **Memory**: 512MB minimum, 1GB recommended
- **Storage**: 10GB minimum for application and uploads

#### **Deployment Steps**
```bash
# 1. Clone and setup
git clone https://github.com/Shareiar-shams/AH-Vision.git
cd AH-Vision
composer install --optimize-autoloader --no-dev

# 2. Environment configuration
cp .env.example .env
# Edit .env with production settings

# 3. Generate key and cache
php artisan key:generate
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Database setup
php artisan migrate --force
php artisan db:seed --class=ProductionSeeder

# 5. Storage and permissions
php artisan storage:link
chmod -R 755 storage bootstrap/cache

# 6. Build assets
npm ci --production
npm run build
```

#### **Web Server Configuration**

**Apache (.htaccess)**
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

**Nginx**
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/ah-vision/public;

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### **Performance Optimization**

#### **Caching Strategy**
```bash
# Enable OPcache
php artisan optimize

# Redis cache (optional)
CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

#### **Database Optimization**
```sql
-- Add indexes for better performance
CREATE INDEX idx_products_status ON products(status);
CREATE INDEX idx_orders_user_status ON orders(user_id, order_status);
CREATE INDEX idx_mlmusers_activations ON mlmusers(admin_activation, parent_activation);
```

## 📱 Mobile Responsiveness

AH-Vision is fully responsive and optimized for:
- **Desktop**: Full-featured experience
- **Tablet**: Touch-optimized interface
- **Mobile**: Mobile-first design approach
- **PWA Ready**: Progressive Web App capabilities

## 🌍 Internationalization

### **Multi-language Support**
- **Language Files**: Located in `lang/` directory
- **Dynamic Translation**: Runtime language switching
- **RTL Support**: Right-to-left language support
- **Currency Localization**: Region-specific currency formatting

### **Adding New Language**
```bash
# Create language files
php artisan lang:publish

# Add translations in lang/{locale}/
# Example: lang/es/messages.php for Spanish
```

## 🔧 Customization

### **Theme Customization**
- **CSS Framework**: TailwindCSS for easy styling
- **Component System**: Reusable Blade components
- **Asset Pipeline**: Vite for modern asset compilation
- **Custom Themes**: Easy theme switching capability

### **Plugin Development**
- **Service Providers**: Laravel service provider architecture
- **Event System**: Hook into application events
- **Custom Middleware**: Add custom request processing
- **API Extensions**: Extend API functionality

## 📞 Support & Documentation

### **Getting Help**
- **Documentation**: Comprehensive inline documentation
- **Issue Tracker**: GitHub issues for bug reports
- **Community**: Join our community discussions
- **Professional Support**: Available for enterprise clients

### **Useful Links**
- **Live Demo**: [https://ahknoxo.com/](https://ahknoxo.com/)
- **Documentation**: [Wiki Pages](https://github.com/Shareiar-shams/AH-Vision/wiki)
- **API Reference**: [API Documentation](https://ahknoxo.com/api/docs)

## 🤝 Contributing

We welcome contributions from the community! Here's how you can help:

### **Ways to Contribute**
- **Bug Reports**: Report issues and bugs
- **Feature Requests**: Suggest new features
- **Code Contributions**: Submit pull requests
- **Documentation**: Improve documentation
- **Testing**: Help with testing new features

### **Development Setup**
```bash
# Fork the repository
git clone https://github.com/yourusername/AH-Vision.git
cd AH-Vision

# Create feature branch
git checkout -b feature/your-feature-name

# Make changes and commit
git commit -m "Add your feature"

# Push and create pull request
git push origin feature/your-feature-name
```

### **Coding Standards**
- **PSR-12**: Follow PSR-12 coding standards
- **Laravel Conventions**: Use Laravel naming conventions
- **Testing**: Include tests for new features
- **Documentation**: Update documentation for changes

## 📄 License

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

### **MIT License Summary**
- ✅ **Commercial Use**: Use in commercial projects
- ✅ **Modification**: Modify the source code
- ✅ **Distribution**: Distribute the software
- ✅ **Private Use**: Use for private projects
- ❌ **Liability**: No warranty or liability
- ❌ **Trademark Use**: No trademark rights included

## 🙏 Acknowledgments

Special thanks to:
- **Laravel Team**: For the amazing framework
- **Package Authors**: All the package contributors
- **Community**: Beta testers and feedback providers
- **Contributors**: Everyone who helped improve the project

---

<div align="center">

**Made with ❤️ by [Shareiar Shams](https://github.com/Shareiar-shams)**

[![GitHub Stars](https://img.shields.io/github/stars/Shareiar-shams/AH-Vision?style=social)](https://github.com/Shareiar-shams/AH-Vision/stargazers)
[![GitHub Forks](https://img.shields.io/github/forks/Shareiar-shams/AH-Vision?style=social)](https://github.com/Shareiar-shams/AH-Vision/network/members)
[![GitHub Issues](https://img.shields.io/github/issues/Shareiar-shams/AH-Vision)](https://github.com/Shareiar-shams/AH-Vision/issues)

**⭐ Star this repository if you find it helpful!**

</div>
