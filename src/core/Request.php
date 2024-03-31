<?php

/**
 * リクエストクラス
 *
 * @author naito
 * @version ver1.0.0 2024/03/23
 */
class Request
{
    /**
     * ポスト判定
     *
     * @return bool 判定結果
     */
    public function isPost(): bool
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        }
        return false;
    }

    /**
     * パス取得
     *
     * @return string パス
     */
    public function getPathInfo(): string
    {
        return $_SERVER['REQUEST_URI'];
    }
}
