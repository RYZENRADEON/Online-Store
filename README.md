# Instructions for Online-Store (PHP)

## Quick snapshot
- Monolithic PHP app served under XAMPP (document root: `htdocs/Online-Store`).
- Server-rendered pages under `pages/` split into `pages/user` and `pages/admin`.
- Client-side XHRs live in `assets/js/script.js` and expect plain-text responses (e.g., `"success"`, `"sent"`, or an error message string).
- DB access is centralized in `config/connection.php` via the `Database` class which exposes `search($query)` and `iud($query)` (uses mysqli).
- PHPMailer is included from `includes/` (not Composer).

## Important files & patterns (what to look at first)
- `index.php` — main public landing; includes `assets/js/script.js`.
- `assets/js/script.js` — central JS that performs AJAX for signup/signin/forgot/reset flows. It uses FormData and expects literal strings in responses. When editing server-side endpoints, update this file if you change response strings or endpoint paths.
- `config/connection.php` — Database class and credentials (host, user, password, dbname). Note the method `setupConnectin()` name (typo) and use of `Database::$connection`.
- `pages/user/*.php` — user flows: `signupProcess.php`, `signinProcess.php`, `forgotPasswordProcess.php`, `resetPasswordProcess.php`, and the form pages. These scripts typically:
  - `include` the DB connection via relative paths (e.g., `include "../../config/connection.php"`).
  - read `$_POST` directly and echo a short text response.
  - perform DB queries using `Database::search()` with inlined SQL strings (no prepared statements in many places).
- `includes/PHPMailer.php`, `includes/SMTP.php`, `includes/Exception.php` — PHPMailer shipped directly; SMTP credentials are often hard-coded in process scripts.
- `pages/admin/` — admin UI, product management and inventory. Many admin process scripts follow the same procedural pattern as user scripts.
- `database/online_store.mwb` — MySQL Workbench project file representing schema. The repo lacks a SQL dump; use Workbench to export or request a .sql if you need to run the DB locally.

## Conventions & constraints agents must follow
- Responses are plain text (not JSON). Many front-end checks are string-equality (e.g., `responseText.trim() === "success"`). If you change a response value, update corresponding client-side checks in `assets/js/script.js`.
- Endpoints are often referenced from JS by root-relative paths `/Online-Store/pages/...`. Keep these stable; prefer root-relative URLs for reliability.
- Database access: most code concatenates SQL with variables. When editing or adding DB code, prefer using prepared statements accessed through `Database::$connection` (call `Database::setupConnectin()` first), but be consistent with surrounding code and update tests or front-end expectations if you change output format.
- PHPMailer: since it's included without Composer, import statements and `require` paths are relative; keep the `includes/` usage consistent or migrate to Composer with an explicit PR and update all mail requires.
- Don't remove or rename `Database::setupConnectin()` without updating all call sites (search for `setupConnectin`/`Database::setupConnectin()` first).

## Local run / dev notes
- Run: start XAMPP (Apache + MySQL) and open `http://localhost/Online-Store/index.php`.
- DB: import the schema (use `database/online_store.mwb` in MySQL Workbench or ask the team for a SQL dump). Credentials are in `config/connection.php` (by default: `localhost`, `root`, password `72927292`, db `online_store`, port 3306).
- Email: SMTP creds are embedded in scripts (e.g., `forgotPasswordProcess.php`). For local testing, either use valid SMTP credentials or stub out `mail->send()` and return `"sent"` for UI flow testing.
- No automated tests or CI configuration present; rely on local manual testing and quick smoke checks with curl/XHR.

## Typical code change checklist for agents
- If changing a server-side endpoint:
  - Update `assets/js/script.js` if request path or response text changes.
  - Keep responses plain text unless you update all consumers to handle JSON.
  - Use prepared statements for new DB work; where refactoring, aim to not break existing queries.
- When touching email flows:
  - Preserve the reset link parameter names (e.g., `?code=...`) consumed by `resetPassword.php`/`resetPasswordProcess.php`.
  - Verify PHPMailer requires are correctly relative to the edited file.
- Security: watch for SQL injection and plaintext credentials in the codebase.

## Examples (search patterns useful to agents)
- Find where a field is read from POST and echoed as a response:
  - search: `echo ("` or `echo "` in `pages/user` and `pages/admin`.
- Find db queries: `Database::search("SELECT` or `Database::search("UPDATE`.
- Find AJAX endpoints: open `assets/js/script.js` (signup/signin/forgot/reset).

## When to open a PR vs quick fix
- Quick non-breaking fixes (typos in HTML, JS path fixes): small PRs with a short description and smoke test steps.
- Security or API-contract changes (switch to JSON responses, add prepared statements, change response strings): open a design PR, document the migration steps (update front-end, add tests where possible), and add run instructions.

---

If anything here is unclear or you'd like stronger rules (e.g., prefer Composer for PHPMailer, migrate all SQL to prepared statements), tell me which policy to apply and I will update this file accordingly.
