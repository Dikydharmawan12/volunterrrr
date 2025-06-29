#!/bin/bash

echo "🚀 Starting deployment of Laravel application..."

# Build and start the application
echo "📦 Building Docker image..."
docker-compose -f docker-compose.prod.yml build

echo "🔄 Starting containers..."
docker-compose -f docker-compose.prod.yml up -d

echo "✅ Application is running!"
echo "🌐 Access your application at: http://localhost"
echo "📊 To view logs: docker-compose -f docker-compose.prod.yml logs -f"
echo "🛑 To stop: docker-compose -f docker-compose.prod.yml down" 