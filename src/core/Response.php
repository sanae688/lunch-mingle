<?php

/**
 * レスポンスクラス
 *
 * @author naito
 * @version ver1.0.0 2024/03/23
 */
class Response
{
    /* @var string  コンテンツ */
    protected string $content;

    /* @var string ステータスコード */
    protected string $statusCode;

    /* @var string ステータステキスト */
    protected string $statusText;

    /**
     * 画面情報読み込み
     */
    public function send(): void
    {
        header('HTTP/1.1 ' . $this->statusCode . ' ' . $this->statusText);
        if ($this->statusCode === '200') {
            echo $this->content;
        } else {
            include($this->content);
        }
    }

    /**
     * コンテンツ設定
     *
     * @param string $content コンテンツ
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * ステータス設定
     *
     * @param string $statusCode ステータスコード
     * @param string $statusText ステータステキスト
     */
    public function setStatusCode($statusCode, $statusText): void
    {
        $this->statusCode = $statusCode;
        $this->statusText = $statusText;
    }
}
