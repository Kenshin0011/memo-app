FROM node:24.22.1

COPY ./laravel /var/www/html

WORKDIR /var/www/html

RUN if [ -f package.json ]; then \
    corepack enable && CI=true pnpm install --frozen-lockfile; \
    fi

EXPOSE 5173
# exposeでは実際のポートに影響しない

ENTRYPOINT [ "bash", "-c", "if [ -f package.json ]; then pnpm run dev; else echo 'No package.json found. Keeping Container alive.' && tail -f /dev/null; fi" ]
