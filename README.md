# シャッフルランチサービス

## 環境構築

### 1. 基本

```bash
# Docker イメージのビルド
docker-compose build

# Docker コンテナの起動
docker-compose up -d

# Docker コンテナの停止・削除
docker-compose down
```
### 2. Remote Development

Docker イメージをビルドする。

```bash
# Docker イメージのビルド
docker-compose build
```

VSCode の Remote-Containers: Open Folder in Container からコンテナを開く。

コマンドは VSCode のターミナルから実行する。

終了するときはコンテナを停止・削除する。

```bash
# Docker コンテナの停止・削除
docker-compose down
```

### 2. DB初期設定

```bash
# DB 初期設定
docker compose exec app php setup/InitialData.php
```
## シャッフルランチサービス使用方法

**※必ず「環境構築」が完了してから下記実施すること**

**システム概要：**

* 社員同士の交流のため、ランチに行くメンバーをランダムにグループ分けするシステム

```bash
# TOP画面(従業員シャッフル画面)
http://localhost:50080/employeeShuffle

# 従業員登録画面
http://localhost:50080/employeeRegistration

# 従業員更新画面
http://localhost:50080/employeeUpdate
```

## 目的

* フルスクラッチでアプリケーションを作成する
* Webアプリケーション(MVCモデル)の仕組みの理解を深める
* バックエンドをメインとするため、フロントエンド(html,css,js)に関しては最低限の実装となっている
* シャッフルランチサービス作成にあたり作成したファイル(src配下)
```bash
.
├── controller
│   ├── EmployeeUpdateController.php
│   ├── EmployeeRegistrationController.php
│   └── EmployeeShuffleController.php
├── core
│   ├── View.php
│   ├── AutoLoader.php
│   ├── Controller.php
│   ├── DatabaseManager.php
│   ├── DatabaseModel.php
│   ├── HttpBadRequestException.php
│   ├── HttpNotFoundException.php
│   ├── Request.php
│   ├── Response.php
│   └── Router.php
├── enum
│   └── Status.php
├── models
│   └── Employee.php
├── setup
│   └── InitialData.php
├── views
│   ├── layout.php
│   ├── employeeRegistration
│   │   └── index.php
│   ├── employeeShuffle
│   │   └── index.php
│   ├── employeeUpdate
│   │   └── index.php
│   └── error
│       ├── 400BadRequestError.php
│       ├── 404NotFoundError.php
│       └── 500InternalServerError.php
├── web
│   └── index.php
│       └── .htaccess
├── Application.php
└── bootstrap.php
```

## 教材

[独学エンジニア](https://dokugaku-engineer.com/)
