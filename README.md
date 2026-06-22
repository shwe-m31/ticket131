<div align="center">

<!-- Animated banner -->
<img src="https://readme-typing-svg.herokuapp.com?font=Fira+Code&size=32&pause=1000&color=6C63FF&center=true&vCenter=true&width=600&lines=🎟️+Welcome+to+FlexiGo;One+Platform.+All+Bookings.;Movies+%7C+Flights+%7C+Concerts" alt="FlexiGo Typing SVG" />


<img src="https://user-images.githubusercontent.com/74038190/212284100-561aa473-3905-4a80-b561-0d28506553ee.gif" width="700"/>

</div>

---

## 📽️ Demo Video

<div align="center">

**▶️ Watch FlexiGo in action — full end-to-end booking walkthrough**

https://github.com/user-attachments/assets/40ee5024-83c9-48cc-8abc-36e03aa8f765

</div>

---

## 🌟 What is FlexiGo?

> **FlexiGo** is a **centralized ticket booking platform** that unifies movie, flight, and concert reservations into one sleek, secure web application — eliminating the need to juggle multiple apps.

---

## 🚩 Problem Statement

<img align="right" src="https://user-images.githubusercontent.com/74038190/212284158-e840e285-664b-44d7-b79b-e264b5e54825.gif" width="220"/>

Most ticket booking platforms are **siloed**:
- 🎬 One app for movies
- ✈️ Another for flights
- 🎵 Yet another for concerts

Users waste time switching between apps just to plan a single outing or trip. **FlexiGo fixes this** by bringing all three into one seamless, secure, and fast platform with a unified login and payment system.

---

## ✅ Solution at a Glance

| Challenge | FlexiGo's Answer |
|---|---|
| Multiple apps needed | Single unified platform |
| Separate logins | One secure account for everything |
| Slow booking process | Streamlined 3-step flow |
| Payment scattered | Integrated multi-method gateway |
| No booking history | Centralized management dashboard |

---

## 🛠️ Tech Stack

<div align="center">

| Layer | Technology |
|---|---|
| 🏗️ Markup | HTML5 |
| 🎨 Styling | CSS3 + Bootstrap 5 |
| ⚡ Interactivity | JavaScript (Vanilla) |
| 🔧 Backend | PHP |
| 🗄️ Database | MySQL |

</div>

---

## 🔄 Application Workflow

```mermaid
flowchart TD
    A([🚀 Start]) --> B[Open FlexiGo App\nLogin page displayed]
    B --> C{New User?}
    C -- Yes --> D[📝 Register Account]
    C -- No --> E[🔐 Login with Credentials]
    D --> E
    E --> F{Auth Valid?}
    F -- No --> G[❌ Show Error\nRetry Login]
    G --> E
    F -- Yes --> H[🏠 Dashboard]

    H --> I[🎬 Movies]
    H --> J[✈️ Flights]
    H --> K[🎵 Concerts]

    I --> I1[Browse & Search Films]
    I1 --> I2[View Movie Details]
    I2 --> I3[Select Showtime & Seats]

    J --> J1[Search by Route & Date]
    J1 --> J2[Compare Flights]
    J2 --> J3[Enter Passenger Details]

    K --> K1[Browse Events by City]
    K1 --> K2[View Event Details]
    K2 --> K3[Choose Seating Category]

    I3 --> P[💳 Payment Gateway\nCard / UPI / Wallet / Net Banking]
    J3 --> P
    K3 --> P

    P --> Q{Payment\nSuccessful?}
    Q -- No --> R[🔄 Retry Payment]
    R --> P
    Q -- Yes --> S[✅ Booking Confirmed\nSummary & Receipt Sent]
    S --> T([🎉 End])

    style A fill:#6C63FF,color:#fff,stroke:#6C63FF
    style T fill:#6C63FF,color:#fff,stroke:#6C63FF
    style H fill:#10B981,color:#fff,stroke:#10B981
    style P fill:#10B981,color:#fff,stroke:#10B981
    style S fill:#10B981,color:#fff,stroke:#10B981
    style I fill:#F97316,color:#fff,stroke:#F97316
    style J fill:#3B82F6,color:#fff,stroke:#3B82F6
    style K fill:#F59E0B,color:#fff,stroke:#F59E0B
    style I1 fill:#FED7AA,color:#92400E,stroke:#F97316
    style I2 fill:#FED7AA,color:#92400E,stroke:#F97316
    style I3 fill:#FED7AA,color:#92400E,stroke:#F97316
    style J1 fill:#BFDBFE,color:#1E3A8A,stroke:#3B82F6
    style J2 fill:#BFDBFE,color:#1E3A8A,stroke:#3B82F6
    style J3 fill:#BFDBFE,color:#1E3A8A,stroke:#3B82F6
    style K1 fill:#FDE68A,color:#78350F,stroke:#F59E0B
    style K2 fill:#FDE68A,color:#78350F,stroke:#F59E0B
    style K3 fill:#FDE68A,color:#78350F,stroke:#F59E0B
    style G fill:#FCA5A5,color:#7F1D1D,stroke:#EF4444
    style R fill:#FCA5A5,color:#7F1D1D,stroke:#EF4444
```

---

## 🚀 Key Features

<div align="center">
<img src="https://user-images.githubusercontent.com/74038190/212749447-bfb7e725-6987-49d9-ae85-2015e3e7cc41.gif" width="400"/>
</div>

<br/>

| # | Feature | Description |
|---|---|---|
| 🔐 | **Secure Authentication** | Login, registration & password recovery |
| 🎬 | **Movie Booking** | Browse films, pick showtimes, confirm seats |
| ✈️ | **Flight Booking** | Search routes, compare flights, book seats |
| 🎵 | **Concert Booking** | Discover events, choose categories, buy tickets |
| 💳 | **Payment Gateway** | Card, UPI, Wallet & Net banking support |
| 📋 | **Booking Management** | View & track all reservations in one place |
| 📱 | **Responsive Design** | Mobile-first with Bootstrap 5 |
| 🔑 | **Forgot Password** | Hassle-free account recovery flow |

---

## 📂 Module Breakdown

<details>
<summary>🔐 <strong>Authentication Module</strong></summary>
<br/>
Handles user registration, login, and session management via PHP and MySQL. Passwords are securely hashed. Includes a complete Forgot Password recovery flow.
</details>

<details>
<summary>🎬 <strong>Movie Booking Module</strong></summary>
<br/>
Users search films, view details (cast, timing, ratings), select a showtime, pick seats, and confirm — all driven by real-time PHP-MySQL queries.
</details>

<details>
<summary>✈️ <strong>Flight Booking Module</strong></summary>
<br/>
Search by origin, destination, and travel date. Compare available flights, select preferred options, enter passenger details, and proceed to payment.
</details>

<details>
<summary>🎵 <strong>Concert Booking Module</strong></summary>
<br/>
Browse upcoming concerts by city and date. View event details, choose seating categories, and complete ticket purchase with confirmation.
</details>

<details>
<summary>💳 <strong>Payment Module</strong></summary>
<br/>
A secure multi-method gateway supporting Cards, UPI, Wallets, and Net Banking. Processes transactions and generates instant booking confirmation on success.
</details>

---

## 🔮 Future Enhancements

- 🏨 Hotel & stay booking integration
- 🚌 Bus and cab reservation
- 🔔 Push notifications for booking reminders
- 🌍 Multi-language support
- ⭐ User reviews and ratings
- 📊 Admin analytics dashboard
- 📱 Native mobile app (iOS & Android)

---

## ⚙️ Getting Started

```bash
# 1. Clone the repository
git clone https://github.com/YOUR_USERNAME/flexigo.git
cd flexigo

# 2. Import the database
#    Open phpMyAdmin → Import → select flexigo.sql

# 3. Configure DB connection
#    Edit config/db.php with your MySQL credentials

# 4. Start local server
php -S localhost:8000

# 5. Open in browser
#    http://localhost:8000
```

---

## 📄 License

This project is licensed under the [MIT License](LICENSE).

---

<div align="center">

<img src="https://user-images.githubusercontent.com/74038190/212284115-f47cd8ff-2ffb-4b04-b5bf-4d1c14c0247f.gif" width="400"/>

**⭐ If you found this project useful, give it a star!**

*Made with ❤️ — FlexiGo: Book Everything, Everywhere*

</div>
