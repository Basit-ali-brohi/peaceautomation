# Deploying Peace Automation

The site is PHP + MySQL, so it needs a host that runs PHP. Static hosts
(Netlify, GitHub Pages, Vercel's static output) cannot run it — they would
serve the raw source instead of the pages.

This repository ships a `Dockerfile`, so any Docker host can build and run it
straight from GitHub. Two routes are written up below.

---

## Route A — Railway (single platform, quickest)

Railway runs the container and the MySQL database side by side, and redeploys
on every push.

**1. Create the project**

1. Sign in at <https://railway.app> with the GitHub account that owns this repo.
2. **New Project → Deploy from GitHub repo → `peaceautomation`.**
3. Railway detects the `Dockerfile` and starts the first build.

**2. Add the database**

1. In the same project: **New → Database → Add MySQL.**
2. Open the **web service → Variables → Add Variable Reference**, and add these
   five, each pointing at the MySQL service:

   | Variable | Reference |
   |---|---|
   | `DB_HOST` | `${{MySQL.MYSQLHOST}}` |
   | `DB_PORT` | `${{MySQL.MYSQLPORT}}` |
   | `DB_NAME` | `${{MySQL.MYSQLDATABASE}}` |
   | `DB_USER` | `${{MySQL.MYSQLUSER}}` |
   | `DB_PASS` | `${{MySQL.MYSQLPASSWORD}}` |

   (Instead of the five, a single `MYSQL_URL` variable referencing
   `${{MySQL.MYSQL_URL}}` also works — `config/db.php` parses it.)

**3. Expose it**

**Settings → Networking → Generate Domain.** Railway assigns a
`*.up.railway.app` URL and sets `PORT`; the entrypoint makes Apache listen on it.

**4. First boot**

The entrypoint runs `config/migrate.php`, which applies `sql/schema.sql` — the
`inquiries`, `orders`, `order_items` and `product_reviews` tables are created
automatically. Every statement is `CREATE ... IF NOT EXISTS`, so redeploys never
touch existing data.

Watch the deploy log for:

```
[boot] applying database schema…
migrate: 4 statement(s) applied; tables: inquiries, order_items, orders, product_reviews
[boot] Apache listening on 8080
```

**Cost:** Railway's free allowance is a one-off trial credit; continued running
is on the paid Hobby plan (about $5/month at the time of writing). Check their
current pricing page before relying on it.

---

## Route B — Render + an external MySQL (no monthly fee)

Render's free web service tier runs Docker, but Render only offers managed
PostgreSQL, so the database comes from elsewhere.

1. **Database:** create a free MySQL-compatible database — TiDB Cloud
   Serverless, Aiven or Clever Cloud all have free plans. Copy the host, port,
   database name, user and password.
2. **Web service:** Render → **New → Web Service → connect this repo →
   Runtime: Docker → Instance type: Free.**
3. **Environment:** add `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`
   with the values from step 1.
4. Deploy. Render sets `PORT` itself.

**Trade-off:** a free Render service sleeps after inactivity, so the first
request after a quiet spell takes 30–60 seconds. Fine for a demo, not for a
live client site.

---

## Route C — Shared hosting / cPanel (what a client site should use)

1. Upload the project to `public_html` (FTP, or **Git Version Control** in
   cPanel pointed at this repo).
2. **MySQL Databases:** create a database and user, then import `sql/schema.sql`
   through phpMyAdmin.
3. Copy the config files and fill them in:
   ```
   cp includes/config.sample.php includes/config.php
   cp config/db.local.sample.php config/db.local.php   # or set DB_* env vars
   ```
4. Point the domain at `public_html`, install the SSL certificate, done.

No Docker involved — this is the plain LAMP deployment the project was written
for, and it is the cheapest way to run it properly (Pakistani shared hosting is
roughly PKR 200–400/month).

---

## After any deployment

- Fill in `includes/config.php`: phone, WhatsApp number, email, address, social
  links, SMTP credentials and the bank details shown at checkout.
- Set `mail.smtp` to `true` once SMTP details are in. Until then mail falls back
  to PHP `mail()` (which most containers do not have), but every enquiry and
  order is still written to the database and to `storage/`, so nothing is lost.
- Update `url` in `includes/config.php` and the addresses in `sitemap.xml` to the
  live domain.
- Replace the placeholder product prices in `includes/data.php`.

## Local Docker test

```bash
docker compose up --build
```

Serves the site on <http://localhost:8080> with its own MySQL container.
