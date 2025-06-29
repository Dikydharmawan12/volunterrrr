#!/bin/bash

echo "=== Deploying with Fixed Configuration ==="
echo ""

# Build and push to Railway
echo "Building and deploying to Railway..."
railway up

echo ""
echo "=== Deployment Complete ==="
echo ""
echo "If you still get 500 errors, check the logs with:"
echo "railway logs"
echo ""
echo "To debug inside the container:"
echo "railway shell"
echo "Then run: ./debug.sh" 