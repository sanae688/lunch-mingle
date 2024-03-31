<?php

/**
 * データベースマネージャークラス
 *
 * @author naito
 * @version ver1.0.0 2024/03/23
 */
class DatabaseManager
{
    /* @var array PDO-オプション */
    private const PDO_OPTIONS = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_CASE => PDO::CASE_NATURAL,
        PDO::ATTR_ORACLE_NULLS => PDO::NULL_NATURAL,
    ];

    /* @var PDO|null データーベース接続情報 */
    protected PDO|null $dbh;

    /* @var array モデル */
    protected array $models;

    /**
     * データーベース接続
     */
    public function dbConnect(): void
    {
        $this->dbh = new PDO(getenv('MYSQL_DNS'), getenv('MYSQL_USER'), getenv('MYSQL_PASSWORD'), self::PDO_OPTIONS);
    }

    /**
     * モデル取得
     *
     * @param string $modelName モデル名
     * @return Employee モデル情報
     */
    public function get($modelName): Employee
    {
        if (!isset($this->models[$modelName])) {
            $model = new $modelName($this->dbh);
            $this->models[$modelName] = $model;
        }

        return $this->models[$modelName];
    }

    public function __destruct()
    {
        $this->dbh = null;
    }
}
