# Peace Automation

Company website for Peace Automation — CCTV surveillance, fire alarm and fire fighting
systems, access control, time attendance and building automation, installed and maintained
across Karachi.

Built as a plain PHP site: no framework, no build step. Drop it on any LAMP host, point the
database config at MySQL and it runs.

---

## Features

**Marketing site**
- Home, About, Services (with per-service detail pages), Industries, Portfolio (with case
  study pages), Blog (with article pages), Packages, Testimonials, FAQs, Careers, Contact
- Shared page hero, mega menu, mobile drawer and pre-footer CTA driven from one data file
- Contact form and newsletter signup with CSRF protection, honeypot and rate limiting
- SEO: per-page titles/descriptions, canonical URLs, LocalBusiness and ItemList JSON-LD,
  sitemap and robots.txt

**Hardware shop**
- Product catalogue with sidebar filters (search, category, feature), sorting and pagination
- Product detail pages: image gallery with lightbox, specifications, description and reviews
- Customer reviews with star ratings, stored in MySQL
- Session cart with live quantity updates, and a checkout that records the order against
  cash on delivery or bank transfer — no card data is handled on the site
- Order confirmation page with reference number, and an email copy to the office

**Front end**
- Responsive from 320px up, verified at phone, tablet and desktop widths
- Design tokens in CSS custom properties — the whole palette lives in `:root`
- GSAP + ScrollTrigger for scroll animation, Lenis for smooth scrolling, Swiper for sliders
- Progressive enhancement: cart, filters and forms all work without JavaScript

---

## Requirements

- PHP 8.1 or newer
- MySQL 5.7 / MariaDB 10.4 or newer
- Apache with `mod_rewrite` (an `.htaccess` is included)

---

## Local setup

```bash
git clone https://github.com/Basit-ali-brohi/peaceautomation.git
cd peaceautomation
```

**1. Configuration**

Both config files are gitignored so credentials never reach the repository. Copy the
samples and fill them in:

```bash
cp includes/config.sample.php includes/config.php
cp config/db.local.sample.php config/db.local.php
```

`includes/config.php` holds the phone number, email, address, social links, SMTP details and
bank transfer details shown at checkout. `config/db.local.php` holds the database
credentials — on a container host, `DB_*` environment variables replace it.

**2. Database**

```bash
mysql -u root -p < sql/schema.sql
```

That creates the `peace_atomation` database with the `inquiries`, `orders`, `order_items`
and `product_reviews` tables.

**3. Serve**

Point a virtual host at the project root, or drop the folder inside `htdocs` and open it
through XAMPP.

---

## Project structure

```
├── api/                 JSON endpoints (contact, newsletter, cart)
├── assets/
│   ├── css/             style.css (tokens + components), shop.css
│   ├── js/              main.js (site), shop.js (cart, gallery, tabs)
│   ├── fonts/           TT Interphases Pro
│   └── images/          photography, logos, icons
├── config/              database connection
├── includes/
│   ├── config.php       site constants and credentials (gitignored)
│   ├── data.php         services, industries, projects, posts, products
│   ├── functions.php    helpers: assets, escaping, CSRF, inline SVG icons
│   ├── shop.php         products, cart, orders, reviews
│   ├── header.php       head, header, mega menu, drawer
│   ├── footer.php       clients strip, CTA, footer, scripts
│   └── page-hero.php    shared inner-page hero
├── sql/schema.sql       database schema
└── storage/             newsletter CSV and order log (gitignored)
```

---

## Content editing

Most repeated content is data, not markup. Services, industries, projects, blog posts and
products all live in `includes/data.php` — add an entry to the relevant array and every
page that loops over it picks the new item up: navigation, listings, detail pages and
sitemap alike.

Product prices are whole rupees in the `products` array. The price always comes from that
file at render time, never from the session, so a stale cart can never carry an old price
into an order.

---

## Deployment

The site needs a host that runs PHP — a static host such as Netlify or GitHub Pages cannot
serve it. A `Dockerfile` is included, so any container host builds it straight from this
repository:

```bash
docker compose up --build     # local test on http://localhost:8080
```

On a container host the database comes from environment variables (`DB_HOST`, `DB_PORT`,
`DB_NAME`, `DB_USER`, `DB_PASS`, or a single `MYSQL_URL`), and the entrypoint applies
`sql/schema.sql` on first boot.

Step-by-step instructions for Railway, Render and cPanel shared hosting are in
[DEPLOY.md](DEPLOY.md).

---

## Notes before going live

- Fill in the real values in `includes/config.php` — phone, WhatsApp number, email, address,
  social links, SMTP credentials and the bank account details shown on the order
  confirmation page.
- Replace the placeholder product prices in `includes/data.php` with the real trade prices.
- Set `mail.smtp` to `true` once the SMTP details are in place; until then order and enquiry
  mail falls back to PHP `mail()`, and every submission is still written to the database and
  to `storage/` so nothing is lost.
- Update `cfg('url')` and `sitemap.xml` with the production domain.

---

© Peace Automation. All rights reserved.
