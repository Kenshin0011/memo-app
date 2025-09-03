.PHONY: up down stop clear init reset destroy app-create front-create storybook storybook-down test test-unit test-feature test-coverage

## Laravelキャッシュ系
clear:
	docker compose exec app php artisan cache:clear
	docker compose exec app php artisan config:clear
	docker compose exec app php artisan route:clear
	docker compose exec app php artisan view:clear

## コンテナ起動
up:
	mkdir -p ./laravel/node_modules
	docker compose up -d

## コンテナ停止
down:
	docker compose down
	make storybook-down

stop:
	docker compose stop

## git clone 直後の初期化（.env作成は手動 or 自動コピー）
init:
	cp -n ./laravel/.env.example ./laravel/.env || true
	docker compose build --no-cache
	make up
	docker compose exec app composer install
	docker compose exec app php artisan key:generate
	docker compose exec app php artisan migrate:fresh --seed

## 開発状態を完全に破棄して初期化
reset:
	make destroy
	make init

## Laravelプロジェクト作成（初回のみ手動）
app-create:
	rm -rf laravel
	mkdir -p laravel
	docker build -t app-image ./infra/development/php --no-cache
	docker run --rm \
		--mount type=bind,source=$(shell pwd)/laravel,target=/var/www/html \
		app-image composer create-project laravel/laravel .

## Vueフロントエンド初期導入
front-create:
	docker compose exec vite npm install -D @vitejs/plugin-vue
	docker compose exec vite npm install -D vue-router@4
	docker compose exec vite npm install -D pinia
	docker compose exec vite npm install -D sass
	docker compose exec vite npm install -D unplugin-vue-router
	docker compose exec vite npm install --save-dev laravel-vite-plugin

## 開発用アセット・不要ファイルを完全削除
destroy:
	docker compose down --rmi all --volumes --remove-orphans
	rm -rf laravel/vendor
	rm -rf laravel/node_modules
	rm -rf laravel/public/build
	rm -rf laravel/public/hot
	rm -rf laravel/public/storage
	rm -f laravel/.env

## Storybookのみ起動
storybook:
	docker compose -f docker-compose.dev.yml --profile adhoc up -d storybook

## Storybook停止
storybook-down:
	docker compose -f docker-compose.dev.yml --profile adhoc down

route:
	docker compose exec app php artisan route:list

## テスト関連
test:
	docker compose exec app php artisan test

test-unit:
	docker compose exec app php artisan test --testsuite=Unit

test-feature:
	docker compose exec app php artisan test --testsuite=Feature

test-coverage:
	docker compose exec app vendor/bin/phpunit --coverage-html coverage

## API curl コマンド
# Usage: make curl METHOD=GET ENDPOINT=/api/memos
# Usage: make curl METHOD=POST ENDPOINT=/api/memos DATA='{"description":"test"}'
# Usage: make curl METHOD=DELETE ENDPOINT=/api/memos/1
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
