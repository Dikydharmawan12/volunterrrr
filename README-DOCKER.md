# 🐳 Docker Deployment Guide

## Prerequisites
- Docker
- Docker Compose

## Quick Start

### 1. Development Environment
```bash
# Build and start development environment
docker-compose up --build

# Access application at http://localhost:8000
```

### 2. Production Environment
```bash
# Make deploy script executable
chmod +x deploy.sh

# Run deployment
./deploy.sh

# Or manually:
docker-compose -f docker-compose.prod.yml up --build -d
```

## Available Commands

### Start Application
```bash
# Development
docker-compose up

# Production
docker-compose -f docker-compose.prod.yml up -d
```

### Stop Application
```bash
# Development
docker-compose down

# Production
docker-compose -f docker-compose.prod.yml down
```

### View Logs
```bash
# Development
docker-compose logs -f

# Production
docker-compose -f docker-compose.prod.yml logs -f
```

### Access Container Shell
```bash
# Development
docker-compose exec app bash

# Production
docker-compose -f docker-compose.prod.yml exec app bash
```

### Run Artisan Commands
```bash
# Development
docker-compose exec app php artisan migrate

# Production
docker-compose -f docker-compose.prod.yml exec app php artisan migrate
```

## Environment Variables

The application uses SQLite database by default. You can modify the environment variables in `docker-compose.prod.yml`:

```yaml
environment:
  - APP_ENV=production
  - APP_DEBUG=false
  - DB_CONNECTION=sqlite
  - DB_DATABASE=/var/www/html/database/database.sqlite
```

## Free Hosting Options

### 1. Railway.app
- Connect your GitHub repository
- Railway will automatically detect Docker configuration
- Free tier available

### 2. Render.com
- Connect your GitHub repository
- Use Docker deployment
- Free tier available

### 3. Fly.io
- Install Fly CLI
- Deploy with: `fly launch`
- Free tier available

### 4. Heroku (with Docker)
- Create `heroku.yml` file
- Deploy with: `heroku container:push web`

## Troubleshooting

### Port Already in Use
If port 80 is already in use, modify the port mapping in `docker-compose.prod.yml`:
```yaml
ports:
  - "8080:80"  # Change 80 to 8080 or another available port
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

## Performance Optimization

The production configuration includes:
- Config caching
- Route caching
- View caching
- Static file caching in Nginx
- Optimized Composer autoloader 