# AGENTS.md

This file provides guidance to WARP (warp.dev) when working with code in this repository.

## Project Overview

**Boutik17** is a French-language Laravel 9 e-commerce application running on XAMPP (macOS). It sells products (primarily perfumes) with a public storefront and a protected admin backoffice. The database is MySQL (`boutik.com`), and the queue driver is `database`.

## Build & Development Commands

```bash
# Serve the application (via XAMPP or built-in server)
php artisan serve

# Run database migrations
php artisan migrate

# Run the queue worker (required for order processing)
php artisan queue:work

# Clear caches
php artisan cache:clear && php artisan config:clear && php artisan view:clear

# Install dependencies
composer install
npm install

# Build frontend assets
npm run dev     # development with HMR
npm run build   # production build

# Run tests
php vendor/bin/phpunit
php vendor/bin/phpunit --filter=ExampleTest   # single test

# Linting (Laravel Pint)
php vendor/bin/pint
```

## Architecture

### Pattern: Repository + Service Layer

Controllers never interact with Eloquent models directly for complex operations. The flow is:

**Controller → Repository → Model** (for data access)
**Controller → Service** (for business logic like file uploads, PDF generation, emails)

- `app/Repositories/ProductRepository.php` — all product, category, and subcategory queries and mutations
- `app/Repositories/CommandRepository.php` — order (commande) persistence and status updates
- `app/Services/Service.php` — shared utilities: file upload (`uploadFile`), product code generation (`codeProduct`), stock history tracking
- `app/Services/GeneratePdf.php` — invoice PDF generation using Dompdf, saved to `public/invoices/`
- `app/Services/SendMail.php` — sends order confirmation email with PDF attachment

### Order Processing Pipeline (Job Chain)

When a customer places an order, processing is fully asynchronous via queued jobs:

1. `ShoppingController::saveCommande` dispatches `SaveNewCommandJob`
2. `SaveNewCommandJob` saves the order via `CommandRepository::saveNewCommand`, then dispatches `SendCommandEmailJob`
3. `SendCommandEmailJob` generates the invoice PDF, sends confirmation email, and updates the order status

Both jobs have `$timeout = 120` and `$tries = 5`. The queue worker must be running for orders to be processed.

### Two Distinct UI Areas

- **Storefront** (`resources/views/shop/` + `resources/views/layouts/simple/`) — public-facing, uses the `layouts.simple.master` Blade layout. Categories and cart data are injected globally via `MenuComposer` (a View Composer registered in `ViewServiceProvider`).
- **Admin Backoffice** (`resources/views/backoffice/`) — protected by `auth` middleware, uses `backoffice.layout` Blade layout. Static admin UI assets are in `public/admin/assets/`.

### Controllers

- `Client/ShoppingController` — homepage, product browsing by category/subcategory, product detail, checkout
- `Client/CartController` — cart add/remove/update (uses `darryldecode/cart` package, aliased as `Cart`)
- `Admin/AdminController` — product CRUD, category/subcategory management, stock provisioning
- `Admin/CommandController` — order listing and detail view
- `UserController` — authentication (login, password reset), admin user management

### Key Conventions

- **Language**: Route names, DB columns, and UI text are in French (e.g., `nom`, `montant`, `stock`, `identifiant_commande`, `lieuxdelivraison`)
- **Product identification**: Products use a `code_product` field (category code + 4-digit random number) as the primary lookup key in URLs, not the auto-increment `id`
- **Order identification**: Orders use `identifiant_commande` (format: `ACP` + Unix timestamp)
- **File uploads**: Stored in `public/uploads/` with filename format `{timestamp}.{original_name}`
- **Cart**: Session-based via `darryldecode/cart` package, not persisted to database
- **Soft delete pattern**: Categories/subcategories use a `statut` column (1=active, 0=deleted) instead of Laravel's `SoftDeletes` trait. Products use an `archive` column.
- **Models lack `$fillable`/relationships**: Most models (Product, Command, Categorie) are bare with no `$fillable`, `$casts`, or relationship definitions. Repositories handle all field assignments manually.

### Database Column Mapping (Product model)

The `products` table uses French column names:
- `nom` = name, `montant` = price, `stock` = quantity, `categorie` = category FK, `subcategorie` = subcategory FK, `image` = main image filename, `code_product` = unique product code, `nbrvente` = number of sales, `type_achat` = purchase type, `slug`, `archive`, `description`
