# Docker Compose用変数
DCO := docker compose
DCO_DEV := $(DCO) -f docker-compose.dev.yml

## Laravelキャッシュ系
.PHONY: clear
clear:
	$(DCO) exec app php artisan cache:clear
	$(DCO) exec app php artisan config:clear
	$(DCO) exec app php artisan route:clear
	$(DCO) exec app php artisan view:clear

## コンテナ起動
.PHONY: up
up:
	mkdir -p ./laravel/node_modules
	$(DCO) up -d

## コンテナ停止
.PHONY: down
down:
	$(DCO) down
	make playwright-down
	make storybook-down

.PHONY: stop
stop:
	$(DCO) stop

## git clone 直後の初期化（.env作成は手動 or 自動コピー）
.PHONY: init
init:
	cp -n ./laravel/.env.example ./laravel/.env || true
	$(DCO) build --no-cache
	make up
	$(DCO) exec app composer install
	$(DCO) exec app php artisan key:generate
	$(DCO) exec app php artisan migrate:fresh --seed

## 開発状態を完全に破棄して初期化
.PHONY: reset
reset:
	make destroy
	make init

## Laravelプロジェクト作成（初回のみ手動）
.PHONY: app-create
app-create:
	rm -rf laravel
	mkdir -p laravel
	docker build -t app-image ./infra/development/php --no-cache
	docker run --rm \
		--mount type=bind,source=$(shell pwd)/laravel,target=/var/www/html \
		app-image composer create-project laravel/laravel .

## Vueフロントエンド初期導入
.PHONY: front-create
front-create:
	$(DCO) exec vite npm install -D @vitejs/plugin-vue
	$(DCO) exec vite npm install -D vue-router@4
	$(DCO) exec vite npm install -D pinia
	$(DCO) exec vite npm install -D sass
	$(DCO) exec vite npm install -D unplugin-vue-router
	$(DCO) exec vite npm install --save-dev laravel-vite-plugin

## 開発用アセット・不要ファイルを完全削除
.PHONY: destroy
destroy:
	$(DCO) down --rmi all --volumes --remove-orphans
	rm -rf laravel/vendor
	rm -rf laravel/node_modules
	rm -rf laravel/public/build
	rm -rf laravel/public/hot
	rm -rf laravel/public/storage
	rm -f laravel/.env

## Storybookのみ起動
.PHONY: storybook
storybook:
	$(DCO_DEV) --profile adhoc up -d storybook

## Storybook停止
.PHONY: storybook-down
storybook-down:
	$(DCO_DEV) --profile adhoc down

.PHONY: route
route:
	$(DCO) exec app php artisan route:list

## テスト関連
.PHONY: test
test:
	$(DCO) exec app php artisan test

.PHONY: test-unit
test-unit:
	$(DCO) exec app php artisan test --testsuite=Unit

.PHONY: test-feature
test-feature:
	$(DCO) exec app php artisan test --testsuite=Feature

.PHONY: test-coverage
test-coverage:
	$(DCO) exec app vendor/bin/phpunit --coverage-html coverage

## API curl コマンド
# Usage: make curl METHOD=GET ENDPOINT=/api/memos
# Usage: make curl METHOD=POST ENDPOINT=/api/memos DATA='{"description":"test"}'
# Usage: make curl METHOD=DELETE ENDPOINT=/api/memos/1
.PHONY: curl
curl:
	@if [ -z "$(METHOD)" ] || [ -z "$(ENDPOINT)" ]; then \
		echo "Usage: make curl METHOD=<GET|POST|PUT|DELETE> ENDPOINT=</path> [DATA=<json>]"; \
		exit 1; \
	fi
	@if [ -n "$(DATA)" ]; then \
		curl -X $(METHOD) http://localhost:48080$(ENDPOINT) \
			-H "Content-Type: application/json" \
			-d '$(DATA)'; \
	else \
		curl -X $(METHOD) http://localhost:48080$(ENDPOINT); \
	fi
