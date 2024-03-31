<?php

/**
 * ビュークラス
 *
 * @author naito
 * @version ver1.0.0 2024/03/23
 */
class View
{
    /* @var string ディレクトリ元 */
    protected string $baseDir;

    /**
     * コンストラクタ
     *
     * @param string $baseDir ディレクトリ元
     */
    public function __construct($baseDir)
    {
        $this->baseDir = $baseDir;
    }

    /**
     * レイアウト読み込み
     *
     * @param string $path 部品パス
     * @param array<mixed> $variables 変数
     * @param string|false $layout レイアウト
     * @return string|false レイアウト情報
     */
    public function render($path, $variables, $layout = false): string|false
    {
        extract($variables);

        ob_start();
        require $this->baseDir . '/' . $path . '.php';
        $content = ob_get_clean();

        ob_start();
        require $this->baseDir . '/' . $layout . '.php';
        $layout = ob_get_clean();

        return $layout;
    }
}
