# Talka – Real-Time Chat Application with Laravel 12

**Talka** is a modern, fast, and secure messaging application built with **Laravel 12**, leveraging the **Blade** templating engine, the **Chatify** messaging library, and real-time broadcasting via **Pusher**. It offers a smooth, responsive UI designed to deliver a seamless and engaging user experience.

---

## 🚀 Core Technologies

- **Laravel 12** – Secure, RESTful, and powerful backend framework
- **Blade** – Laravel’s native templating engine
- **Chatify** – Real-time Laravel chat system
- **Pusher** – Instant message broadcasting via WebSocket
- **Bootstrap / Tailwind** – Responsive UI framework
- **Laravel Echo** – Listens to broadcast events on the frontend

---

## 🧰 Installation

### Prerequisites

- PHP ≥ 8.2
- Composer
- Node.js & npm
- Web Server (Apache or Nginx)
- **Pusher** API Key
- MySQL / MariaDB / PostgreSQL database

---

### Installation Steps

```bash
# Clone the repository
git clone https://github.com/your-username/talka.git
cd talka

# Install PHP dependencies
composer install

# Install Node dependencies and build assets
npm install && npm run build

# Create environment file and generate key
cp .env.example .env
php artisan key:generate
```

**NB :** 
``` bash
# ìn a laravel 12 project, we need to install broadcasting because the channels.php file is missing by default that automatically install laravel-echo and pusher-js packages for you; however, you may also install these packages manually via 

npm install --save-dev laravel-echo pusher-js
```
