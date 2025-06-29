#!/bin/bash

echo "🧪 Testing Laravel application locally..."

# Check if Docker is running
if ! docker info > /dev/null 2>&1; then
    echo "❌ Docker is not running. Please start Docker first."
    exit 1
fi

# Build and start the application
echo "📦 Building and starting application..."
docker-compose up --build -d

# Wait for application to be ready
echo "⏳ Waiting for application to be ready..."
sleep 30

# Test if application is responding
echo "🔍 Testing application response..."
if curl -f http://localhost:8000 > /dev/null 2>&1; then
    echo "✅ Application is running successfully!"
    echo "🌐 Access your application at: http://localhost:8000"
    echo "📊 View logs: docker-compose logs -f"
    echo "🛑 Stop application: docker-compose down"
else
    echo "❌ Application is not responding. Check logs:"
    docker-compose logs
    echo "🛑 Stopping containers..."
    docker-compose down
    exit 1
fi 