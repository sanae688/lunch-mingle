<?php

/**
 * データベースモデルクラス
 *
 * @author naito
 * @version ver1.0.0 2024/03/23
 */
class DatabaseModel
{
    /* @var PDO データーベース接続情報 */
    protected PDO $dbh;

    /**
     * コンストラクタ
     *
     * @param PDO $dbh データーベース接続
     */
    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    /**
     * データ検索
     *
     * @param string $sql SQL文
     * @param array<mixed> $params パラメーター
     * @return array<mixed> 取得結果
     */
    public function fetchAll($sql, $params = []): array
    {
        $prepare = $this->dbh->prepare($sql);

        if ($params) {
            $prepare->execute($params);
        } else {
            $prepare->execute();
        }

        return $prepare->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * データ登録
     *
     * @param string $sql SQL文
     * @param array<mixed> $params パラメーター
     * @return Status 登録結果
     */
    public function execute($sql, $params = []): Status
    {
        $prepare = $this->dbh->prepare($sql);

        if ($params) {
            $execute = $prepare->execute($params);
        } else {
            $execute = $prepare->execute();
        }

        $result = '';
        if ($execute) {
            $result = Status::SUCCESS;
        } else {
            $result = Status::ERROR;
        }

        return $result;
    }
}
