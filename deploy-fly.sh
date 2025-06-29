#!/bin/bash

echo "🚀 Deploying to Fly.io..."

# Check if Fly CLI is installed
if ! command -v fly &> /dev/null; then
    echo "❌ Fly CLI not found. Installing..."
    curl -L https://fly.io/install.sh | sh
fi

# Login to Fly.io
echo "🔐 Logging in to Fly.io..."
fly auth login

# Launch the application
echo "📦 Launching application..."
fly launch --no-deploy

# Deploy the application
echo "🚀 Deploying application..."
fly deploy

echo "✅ Deployment completed!"
echo "🌐 Your application is now live on Fly.io!" 