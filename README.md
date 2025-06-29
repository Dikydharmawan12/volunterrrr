# 🎯 Sistem Pendaftaran Divisi - Laravel

Aplikasi web untuk mengelola pendaftaran divisi dengan fitur admin dan user interface yang responsif.

## 🚀 Quick Start dengan Docker

### Prerequisites
- Docker
- Docker Compose

### 1. Clone Repository
```bash
git clone <repository-url>
cd pendaftaran-divisi
```

### 2. Development Environment
```bash
# Build dan jalankan aplikasi
docker-compose up --build

# Akses aplikasi di http://localhost:8000
```

### 3. Production Environment
```bash
# Jalankan script deployment
chmod +x deploy.sh
./deploy.sh

# Atau manual
docker-compose -f docker-compose.prod.yml up --build -d
```

## 🌐 Free Hosting Options

### 1. Railway.app (Recommended)
```bash
# Install Railway CLI
npm install -g @railway/cli

# Deploy
chmod +x deploy-railway.sh
./deploy-railway.sh
```

### 2. Render.com
1. Connect repository ke Render
2. Pilih "Docker" sebagai environment
3. Render akan otomatis mendeteksi `render.yaml`

### 3. Fly.io
```bash
# Install Fly CLI
curl -L https://fly.io/install.sh | sh

# Deploy
chmod +x deploy-fly.sh
./deploy-fly.sh
```

### 4. Heroku
```bash
# Install Heroku CLI
# Deploy dengan Docker
heroku container:push web
heroku container:release web
```

## 📁 Project Structure

```
pendaftaran-divisi/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminDivisiController.php
│   │   ├── AdminPengaturanController.php
│   │   ├── PendaftaranController.php
│   │   └── WelcomeController.php
│   ├── Models/
│   │   ├── Divisi.php
│   │   ├── Pendaftaran.php
│   │   └── PengaturanAcara.php
│   └── Middleware/
│       └── AdminVerified.php
├── resources/views/
│   ├── admin/
│   │   ├── divisi/
│   │   └── pengaturan/
│   ├── pendaftaran/
│   └── layouts/
├── database/
│   ├── migrations/
│   └── seeders/
├── docker/
│   ├── nginx.conf
│   └── supervisord.conf
├── Dockerfile
├── docker-compose.yml
├── docker-compose.prod.yml
└── README-DOCKER.md
```

## 🛠️ Features

- **Admin Panel**: Kelola divisi dan pengaturan acara
- **Pendaftaran**: Form pendaftaran yang user-friendly
- **Verification**: Sistem verifikasi admin
- **Responsive Design**: Menggunakan Tailwind CSS
- **Database**: SQLite untuk kemudahan deployment

## 🔧 Configuration

### Environment Variables
```env
APP_ENV=production
APP_DEBUG=false
DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### Database
Aplikasi menggunakan SQLite secara default untuk kemudahan deployment. Database akan dibuat otomatis saat pertama kali menjalankan aplikasi.

## 📊 Commands

### Docker Commands
```bash
# Start development
docker-compose up

# Start production
docker-compose -f docker-compose.prod.yml up -d

# View logs
docker-compose logs -f

# Stop application
docker-compose down

# Access container
docker-compose exec app bash
```

### Artisan Commands
```bash
# Run migrations
docker-compose exec app php artisan migrate

# Seed database
docker-compose exec app php artisan db:seed

# Clear cache
docker-compose exec app php artisan cache:clear
```

## 🚨 Troubleshooting

### Port Already in Use
```bash
# Ubah port di docker-compose.prod.yml
ports:
  - "8080:80"  # Ganti 80 dengan port yang tersedia
```

### Permission Issues
```bash
# Fix storage permissions
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 755 /var/www/html/storage
```

### Database Issues
```bash
# Reset database
docker-compose exec app php artisan migrate:fresh --seed
```

## 📈 Performance

Aplikasi sudah dioptimasi untuk production dengan:
- Config caching
- Route caching
- View caching
- Static file caching di Nginx
- Optimized Composer autoloader

## 🤝 Contributing

1. Fork repository
2. Create feature branch
3. Commit changes
4. Push to branch
5. Create Pull Request

## 📄 License

This project is licensed under the MIT License.

## 🆘 Support

Untuk bantuan lebih lanjut, silakan buat issue di repository ini.
