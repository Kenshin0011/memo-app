# 🎓 Intern Laravel Vue Practice

このリポジトリは Laravel + Vue 3 + Vite + Tailwind CSS を Docker 開発環境で構築し、モダンなフロントエンドとバックエンドを統合的に学習・開発できる練習プロジェクトです。

---

## 📚 使用技術

* Laravel 12.x
* Vue 3 (`<script setup>`)
* Vite
* Tailwind CSS v3
* Pinia
* TypeScript
* Docker / Docker Compose

---

## 🐳 開発環境構築手順

### 初期化

```bash
make init
```

### 🔌 PhpStormでDBに接続するステップ

1. Database タブを開く
   • PhpStorm 画面の右上または左下の「Database」タブを開く
2. データソースの追加
   • 「＋」ボタンをクリック
   • Data Source → MySQL を選択
3. 接続設定を入力

| 項目       | 値         |
|----------|-----------|
| Host     | localhost |
| Port     | 43306     |
| User     | laravel   |
| Password | laravel   |
| Database | laravel   |

4. ドライバーのダウンロード
   • 右側に「Download missing driver」と表示されたらクリックしてダウンロード
5. 接続確認
   • 「Test Connection」ボタンをクリック
   • 成功すれば「Success」と表示される
6. 保存
   • 「OK」または「Apply」で保存

### 💡 補足

• Laravel 内部では .env の DB_HOST=db を使用しますが、PhpStorm などローカルツールからは localhost:43306 を使用します
• GUI からテーブルやデータを確認できるので、DBデバッグや開発がスムーズになります

実行内容：

* `.env` のコピー（存在しない場合）
* Docker イメージビルド
* Laravel セットアップ（`composer install`, `key:generate`, `migrate --seed`）

---

## 💠 よく使う Make コマンド

| コマンド                | 内容                                    |
|---------------------|---------------------------------------|
| `make up`           | コンテナ起動                                |
| `make down`         | コンテナ停止・削除                             |
| `make stop`         | コンテナ停止のみ                              |
| `make clear`        | Laravel のキャッシュ削除（route, config, view） |
| `make reset`        | コンテナ・依存をすべて削除して再構築                    |
| `make destroy`      | node\_modules や vendor など開発アセット削除     |
| `make app-create`   | Laravel プロジェクトを初期生成（初回のみ）             |
| `make front-create` | Vue / Vite / Tailwind などフロント環境導入      |
| `make storybook`    | Storybookコンテナ起動                       |

---

## 🌐 アクセスURL

| サービス            | URL                                              |
|-----------------|--------------------------------------------------|
| Laravel         | [http://localhost:48080](http://localhost:48080) |
| Vite Dev Server | [http://localhost:5173](http://localhost:5173)   |
| Storybook       | [http://localhost:6006](http://localhost:6006)   |

---

## 📁 主なフロントエンドのディレクトリ構成

```
laravel/
├── resources/
│   ├── css/app.css         # Tailwind のエントリポイント
│   ├── js/
│   │   ├── apis/           # API 通信
│   │   ├── @types/         # TypeScript 型定義(.d.ts)
│   │   ├── components/     # 再利用可能なコンポーネント
│   │   ├── constants/      # 定数
│   │   ├── features/       # 機能単位コンポーネント
│   │   ├── layouts/        # レイアウトコンポーネント
│   │   ├── pages/          # ルーティング対象ページ
│   │   ├── router/         # auto routing 設定
│   │   ├── stores/         # Pinia ストア
│   │   ├── types/          # TypeScript 型定義(.ts)
│   │   ├── utils/          # ユーティリティ関数
│   │   ├── app.ts          # エントリポイント
│   │   ├── App.vue         # ルートコンポーネント
│   │   └── bootstrap.ts    # axiosの設定
├── public/
│   ├── build/              # Vite によるビルド出力
├── .env                    # Laravel 環境変数
├── tailwind.config.ts      # Tailwind CSS 設定
├── vite.config.js
└── ...
```

## 📁 主なバックエンドのディレクトリ構成

```
laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/    # コントローラー
│   │   ├── Requests/       # フォームリクエストバリデーション
│   │   └── Resources/      # 整形したレスポンス
│   ├── Models/             # Eloquent モデル
│   ├── Providers/          # サービスプロバイダー
│   └── Services/           # サービスクラス
│       └── UseCases/       # ユースケース
├── database/               # マイグレーション、シーディング
├── routes/                 # ルーティング定義
├── .env                    # 環境変数
└── ...
```
