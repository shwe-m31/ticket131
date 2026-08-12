# FlexiGo – Online Ticket Booking Platform

## Original stack

HTML5, CSS3, Bootstrap 5, vanilla JavaScript, PHP, and MySQL. The application
uses PHP sessions for booking state and the Amadeus test API for flight search.

## Requirements

- XAMPP (Apache and MySQL) on Windows
- PHP 7.4+ (PHP 8.x is suitable; `mysqli`, cURL, and JSON extensions enabled)
- MySQL 5.7+ or MariaDB 10+
- A modern browser with JavaScript enabled
- Internet access for Bootstrap CDN, map lookups, and Amadeus test flight search

## Installation and database setup

1. Install XAMPP and copy this repository folder to `C:\xampp\htdocs\ticket131`.
2. Start **Apache** and **MySQL** in the XAMPP Control Panel.
3. Open phpMyAdmin at `http://localhost/phpmyadmin/` (or use the MySQL client).
4. Import `flexigo_database.sql`, or run:

   `mysql -u root -p < flexigo_database.sql`

   For the default XAMPP installation, leave the password blank when prompted.
5. `server.php` expects host `localhost`, user `root`, an empty password, and
   database `flexigo`. Change those four values there if your local MySQL setup
   differs.

## Running the application

Open the original landing carousel at:

`http://localhost/ticket131/start1.php`

You can also open `http://localhost/ticket131/login.php` directly. `index.html`
is retained as part of the original repository, but PHP pages must be served by
Apache for database and session behavior.

## Demo account

Email: `demo@flexigo.local`  
Password: `FlexiGoDemo123`

## Test workflows

1. Sign in with the demo account (or register a new account).
2. Browse **Movies**, open a movie, choose a showtime and seats, continue to
   payment, and submit a payment method to view the ticket.
3. Browse **Concerts**, choose a concert and attendee count, continue through
   payment, and view/download the concert ticket.
4. Browse **Flights**, search a route/date, choose a fare, enter passenger
   details, and continue to payment.
5. Open Profile and Edit Profile, verify the updated values, then log out.

## Recovery assumptions and limitations

- The only recoverable database schema is `signin_det`, because it is the only
  table named in repository SQL. Booking records are not persisted to MySQL in
  this version.
- The existing login and registration SQL stores and compares plaintext
  passwords. The recovery script matches that behavior so the original code
  continues to work; do not use the demo account outside local development.
- Flight search depends on the hardcoded Amadeus test credentials and external
  network/API availability.
- `styles.css` and `script.js` are referenced by some original pages but are not
  present in the repository; those pages include their functional styles and
  validation inline, so no replacement UI files were introduced.
