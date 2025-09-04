FROM mcr.microsoft.com/playwright:v1.55.0-noble

WORKDIR /app

# Copy package files
COPY package*.json ./

# Install dependencies
RUN npm ci

# Copy the rest of the application
COPY . .

# Install Playwright browsers (they should already be in the base image, but this ensures they're up to date)
RUN npx playwright install --with-deps

# Default command
CMD ["npx", "playwright", "test"]