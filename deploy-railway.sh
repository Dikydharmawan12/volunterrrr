#!/bin/bash

echo "🚀 Deploying to Railway..."

# Check if Railway CLI is installed
if ! command -v railway &> /dev/null; then
    echo "❌ Railway CLI not found. Installing..."
    npm install -g @railway/cli
fi

# Login to Railway (if not already logged in)
echo "🔐 Logging in to Railway..."
railway login

# Deploy to Railway
echo "📦 Deploying application..."
railway up

echo "✅ Deployment completed!"
echo "🌐 Your application is now live on Railway!" 