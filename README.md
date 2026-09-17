# Podomoro Laundry

A **Laravel**-based laundry management system, built as an Informatics coursework project. The application combines a public-facing landing site for customers with internal panels for **Staff (Pegawai)** and **Manager** roles to run day-to-day laundry operations.

> Forked from [ferdy146/Project-Laundry](https://github.com/ferdy146/Project-Laundry)

## Features

### Public Website
- Landing page introducing the laundry business
- About page
- Services page listing available laundry services
- Contact page

### Authentication
- Secure login for staff and managers via Laravel's built-in authentication (Laravel Breeze)
- Session-protected logout

### Staff Panel
- Personal dashboard
- Create, view, edit, and delete employee records
- Submit and review attendance (presensi): status, notes, and proof-of-attendance file upload

### Manager Panel
- Overview dashboard
- Full CRUD on employee data
- Review and manage attendance records for the entire staff team, including viewing uploaded attendance files
- Manage the laundry service catalog: add, edit, view, and remove service types (wash type, pricing, turnaround time)

## Access & Roles

The system enforces two distinct access levels, each scoped to its own routes and views:

| Role | What they can do |
|---|---|
| **Staff (Pegawai)** | Manage their own attendance and personal employee data |
| **Manager** | Oversee all staff records, approve/manage attendance company-wide, and control the service catalog offered to customers |

Access to every internal route is gated by `auth` and `verified` middleware, so dashboards and data-entry pages are unreachable without a valid, verified session — the public pages (home, about, services, contact) remain open to visitors.

## Project Impact

This project digitizes what is typically a manual, paper-based laundry operation:

- **Reduces attendance tracking errors** by replacing manual sign-in sheets with a timestamped digital record that includes optional proof-of-attendance uploads.
- **Centralizes service and pricing data**, so staff and managers work from a single source of truth for laundry types, rates, and turnaround times instead of relying on printed price lists.
- **Separates operational responsibility by role**, giving managers oversight of the whole team while letting staff self-serve their own attendance — reducing bottlenecks on a single admin.
- **Establishes a relational data foundation** (customers, transactions, services, attendance) that can be extended into reporting, billing, or customer-facing order tracking in future iterations.

## Implementation

**Stack:** Laravel 11 (PHP ^8.2) on the backend, Blade templates styled with Tailwind CSS and Alpine.js on the frontend, bundled with Vite. Data access goes through Eloquent ORM against a relational database (MySQL/SQLite), with PHPUnit for testing.

**Data model:** Five core tables back the application —
- `users` — staff/manager accounts (name, email, phone, address)
- `pelanggans` (customers) — name, address, phone number
- `laundries` — service catalog (wash type, service type, rate, turnaround duration)
- `transactions` — orders linking a customer and a service, with weight, payment method, and total price
- `presensis` — attendance entries (employee name, status, notes, uploaded file)

**Routing & control flow:** `routes/web.php` defines public routes (home, about, services, contact) alongside role-scoped route groups for `pegawai/*` and `manager/*`, each backed by a dedicated controller (`HomeController`, `PegawaiController`, `ManagerController`, `PresensiController`, `LaundryController`) that handles the CRUD logic for its domain. Authentication routes are handled separately under `Auth/AuthenticatedSessionController`.

**Setup:**

```bash
git clone https://github.com/Menjadianjay/Podomoro-Laundry.git
cd Podomoro-Laundry

composer install
npm install

cp .env.example .env
php artisan key:generate

# configure database credentials in .env, then:
php artisan migrate

npm run dev
php artisan serve
```

The app runs at `http://localhost:8000`. Running the migration seeds a set of default accounts (staff and manager) for local testing — credentials are set in the `users` migration and should be replaced before any production use.

---

Built as a coursework project for Informatics (Laravel).
