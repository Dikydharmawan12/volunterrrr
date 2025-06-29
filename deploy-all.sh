#!/bin/bash

echo "🚀 Laravel Docker Deployment Script"
echo "=================================="

# Function to check if command exists
command_exists() {
    command -v "$1" >/dev/null 2>&1
}

# Function to deploy to Railway
deploy_railway() {
    echo "🌐 Deploying to Railway..."
    if command_exists railway; then
        chmod +x deploy-railway.sh
        ./deploy-railway.sh
    else
        echo "❌ Railway CLI not found. Install with: npm install -g @railway/cli"
    fi
}

# Function to deploy to Fly.io
deploy_fly() {
    echo "🦅 Deploying to Fly.io..."
    if command_exists fly; then
        chmod +x deploy-fly.sh
        ./deploy-fly.sh
    else
        echo "❌ Fly CLI not found. Install with: curl -L https://fly.io/install.sh | sh"
    fi
}

# Function to deploy to Render
deploy_render() {
    echo "🎨 Render deployment instructions:"
    echo "1. Go to https://render.com"
    echo "2. Connect your GitHub repository"
    echo "3. Choose 'Docker' as environment"
    echo "4. Render will automatically detect render.yaml"
    echo "5. Deploy!"
}

# Function to deploy to Heroku
deploy_heroku() {
    echo "⚡ Deploying to Heroku..."
    if command_exists heroku; then
        echo "📦 Pushing to Heroku..."
        heroku container:push web
        heroku container:release web
        echo "✅ Heroku deployment completed!"
    else
        echo "❌ Heroku CLI not found. Install from: https://devcenter.heroku.com/articles/heroku-cli"
    fi
}

# Function to test locally
test_local() {
    echo "🧪 Testing locally..."
    chmod +x test-local.sh
    ./test-local.sh
}

# Main menu
echo ""
echo "Choose deployment option:"
echo "1) Test locally"
echo "2) Deploy to Railway"
echo "3) Deploy to Fly.io"
echo "4) Deploy to Render"
echo "5) Deploy to Heroku"
echo "6) Deploy to all platforms"
echo "7) Exit"
echo ""

read -p "Enter your choice (1-7): " choice

case $choice in
    1)
        test_local
        ;;
    2)
        deploy_railway
        ;;
    3)
        deploy_fly
        ;;
    4)
        deploy_render
        ;;
    5)
        deploy_heroku
        ;;
    6)
        echo "🚀 Deploying to all platforms..."
        test_local
        deploy_railway
        deploy_fly
        deploy_render
        deploy_heroku
        ;;
    7)
        echo "👋 Goodbye!"
        exit 0
        ;;
    *)
        echo "❌ Invalid choice. Please run the script again."
        exit 1
        ;;
esac

echo ""
echo "🎉 Deployment process completed!"
echo "📖 Check README-DOCKER.md for detailed instructions" 