# FlexiGo database schema

## Database

`flexigo`

The source code contains SQL only for the `signin_det` table. Movie, concert,
flight, seat, payment, booking, and ticket data is carried through PHP sessions,
URL parameters, and browser `localStorage`; no corresponding SQL table can be
justified from the repository, so no invented tables are included.

## `signin_det`

| Column | Type | Key | Purpose |
|---|---|---|---|
| `id` | `INT UNSIGNED` | Primary key, auto-increment | Stable user identifier |
| `fname` | `VARCHAR(100)` | Required | First name shown on profile/dashboard |
| `lname` | `VARCHAR(100)` | Required | Last name |
| `gender` | `VARCHAR(30)` | Required | Registration/profile field |
| `email` | `VARCHAR(255)` | Unique, indexed, required | Login and session identity |
| `password` | `VARCHAR(255)` | Required | Compared by the existing plaintext login query |
| `phonenumber` | `VARCHAR(30)` | Required | Profile field |
| `dob` | `DATE` | Required | Profile field |

There are no foreign-key relationships because the repository has no SQL
references to another table.
