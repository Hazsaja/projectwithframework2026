# AGENTS.md

Laravel 13 POS app for "Barokah Mart" (PHP ^8.3, MySQL). Admin and kasir roles. This file is the quick orientation; the full Laravel/Boost conventions already live in `CLAUDE.md` — follow those too.

## Non-obvious context

- This app sits inside the `framework` monorepo and is tracked by git at the workspace root (`.git` is one level up). Run git from here or the root; `.env`, `public/build`, `vendor`, and `node_modules` are ignored.
- Roles: `admin` manages categories, products, reports, and users; `kasir` handles POS and transaction history. Authorization is enforced by the `role:` middleware in `app/Http/Middleware/CheckRole.php` and the route groups in `routes/web.php`.
- Some routes already point at controllers that do **not** exist yet: `ReportController`, `PosController`, `HistoryController`, `UserController`. Their nav links error on click. Check `app/Http/Controllers/` before wiring or debugging a route.
- Every admin page uses `<x-app-layout>` → `components/app-layout.blade.php`, which includes `components/layouts/navigation.blade.php`. The navbar is hand-written with raw `<a>`/`<button>`; it does not use `x-nav-link`/dropdown components.
- Frontend is Tailwind **v3** (`tailwind.config.js`, `@tailwindcss/forms`), not v4. Content globs only cover `resources/views/**/*.blade.php`; rebuild with `npm run build` after view/config edits.
- Laravel 13 models use PHP attributes where present, e.g. `#[Fillable]` / `#[Hidden]` in `app/Models/User.php`. Check sibling models before falling back to `$fillable` / `$hidden`.

## Commands

- First-time setup: `composer run setup` — installs deps, copies `.env`, generates the key, runs `migrate --force`, `npm install --ignore-scripts`, then `npm run build`.
- Dev: `composer run dev` — starts `php artisan serve` + `php artisan queue:listen` + `npm run dev` (Vite). App runs at http://localhost:8000.
- Database is **MySQL** (`DB_DATABASE=pos_toko` in `.env`); session, queue, and cache use the `database` driver, so run `php artisan migrate` before expecting requests, sessions, or queues to work.
- Tests use Pest 5: `php artisan test --compact`, or `vendor/bin/pest`. A single test: `php artisan test --compact --filter=testName` or pass a file path.
- Create files with `php artisan make:* --no-interaction`; Pest tests with `php artisan make:test --pest {Name}`.
- After editing PHP, run `vendor/bin/pint --dirty --format agent`.

## Conventions

- Keep UI changes consistent with the existing Tailwind patterns; clickable elements should have `hover:` states plus `transition-colors`.
- Use named routes with `route()`, never hardcoded URLs.
- Keep `PROMPT_LOG.md` current: append one block per completed prompt following the format at the top of that file. Entries written after the fact are marked `retroactive`.
