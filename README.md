# GurgaonCab.com - Cab Service Website (Laravel)

Dynamic cab booking and travel service website with admin panel, dynamic pages, location pages, and blog management.

## Project Overview

This project is built for a cab service business (`gurgaoncab.com`) where the team can manage:

- Services (airport transfer, outstation, rentals, etc.)
- Vehicles and pricing content
- Routes/cab pages
- Location pages with FAQs
- Blog posts for SEO
- Customer enquiries from frontend forms

The frontend is fully dynamic and most content is manageable from admin.

## Tech Stack

- Framework: Laravel `^12.0`
- PHP: `^8.2`
- Database: MySQL
- Frontend build: Vite (`npm run dev` / `npm run build`)
- Queue/Cache/Session drivers: database-based defaults in env example

## Main Functional Areas

### Frontend

- Home, About, Contact pages
- Services listing and service detail pages
- Vehicles listing and detail pages
- Routes pages and dynamic cab detail pages (`/cab/{slug}`)
- Locations listing and location detail pages
- Blog archive and blog detail pages
- Cab enquiry and service enquiry forms

### Admin Panel

Protected admin routes under `/admin`:

- Dashboard
- Manage Vehicles
- Manage Routes
- Manage Services
- Manage Locations
- Manage Blog Posts
- Manage Location FAQs
- Site Settings
- Enquiry management

### Sitemap

- `/sitemap.xml` -> human-friendly sitemap page (no site header/footer)
- `/sitemap-pages.xml` -> XML sitemap for website pages
- `/sitemap-blog.xml` -> XML sitemap for blog URLs

## How It Works (Flow)

1. Admin creates/updates vehicles, routes, services, locations, blogs.
2. Frontend pages render data from database using slugs.
3. Users submit enquiries from forms.
4. Admin reviews enquiries in admin panel.
5. Sitemaps auto-generate URLs from active records for crawlability.

## Local Setup

### 1) Clone and install

```bash
git clone https://github.com/shishir858/https-gurgaoncab.com.git
cd https-gurgaoncab.com
composer install
npm install
```

### 2) Environment

```bash
cp .env.example .env
php artisan key:generate
```

Set DB values in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gurgaoncab
DB_USERNAME=root
DB_PASSWORD=
```

### 3) Database and storage

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
```

### 4) Run project

```bash
php artisan serve
npm run dev
```

App URL (default): `http://127.0.0.1:8000`

## Useful Commands

```bash
php artisan optimize:clear
php artisan route:list
php artisan test
npm run build
```

## Notes

- Keep `.env` out of version control.
- Uploaded media is served from `public/` and/or `storage`.
- For production, use queue worker and proper cache/session drivers.

## License

This project follows the MIT license (as per Laravel base setup), unless changed by repository owner.
