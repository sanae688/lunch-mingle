<?php

/**
 * データベース初期設定クラス
 *
 * @author naito
 * @version ver1.0.0 2024/03/23
 */
class InitialData
{
    /* @var PDO|null データーベース接続情報 */
    private PDO|null $dbh;

    /* @var array PDO-オプション */
    private const PDO_OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
    ];

    public function __construct()
    {
        echo '************データベース初期設定開始************' . PHP_EOL;
        $this->dbh = new PDO(getenv('MYSQL_DNS'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), self::PDO_OPTIONS);
    }

    /**
     * データベース初期設定
     */
    public function initialData(): void
    {
        $this->initialDeleteTable();
        $this->initialCreateTable();
        $this->dbh = null;
    }

    /**
     * テーブル作成
     */
    public function initialCreateTable(): void
    {
        $sql = <<<EOI
        CREATE TABLE employees(
            employee_id INTEGER COMMENT '従業員id'
            , employee_name VARCHAR (100) NOT NULL COMMENT '従業員名'
            , reg_time TIMESTAMP (6) NOT NULL COMMENT '登録日時'
            , up_time TIMESTAMP (6) NOT NULL COMMENT '更新日時'
            , PRIMARY KEY (employee_id)
        ) COMMENT '従業員テーブル';
        EOI;

        $result = $this->dbh->query($sql);

        if ($result) {
            echo 'テーブル作成完了' . PHP_EOL;
            $result = null;
        } else {
            exit('【テーブル作成エラー】' . PHP_EOL);
        }
    }

    /**
     * テーブル削除
     */
    public function initialDeleteTable(): void
    {
        $sql = 'DROP TABLE IF EXISTS employees';

        $result = $this->dbh->query($sql);

        if ($result) {
            echo 'テーブル削除完了' . PHP_EOL;
            $result = null;
        } else {
            exit('【テーブル削除エラー】' . PHP_EOL);
        }
    }
}

/**
 * 実行
 */
try {
    $dbConnect = new InitialData();
    $dbConnect->initialData();
    echo '************データベース初期設定終了************' . PHP_EOL;
} catch (PDOException $e) {
    exit('【データベース初期設定エラー】' . PHP_EOL . $e->getMessage() . PHP_EOL);
}
