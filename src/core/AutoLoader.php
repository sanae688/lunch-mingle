<?php

/**
 * オートローダークラス
 *
 * @author naito
 * @version ver1.0.0 2024/03/23
 */
class AutoLoader
{
    /* @var array<mixed> ディレクトリ */
    private array $dirs;

    /**
     * オートローダー登録
     */
    public function register(): void
    {
        spl_autoload_register([$this, 'loadClass']);
    }

    /**
     * ディレクトリ登録
     *
     * @param string $dir ディレクトリ
     */
    public function registerDir($dir): void
    {
        $this->dirs[] = $dir;
    }

    /**
     * ファイル読み込み
     *
     * @param string $className クラス名
     */
    public function loadClass($className): void
    {
        foreach ($this->dirs as $dir) {
            $file = $dir . '/' . $className . '.php';
            if (is_readable($file)) {
                require $file;
                return;
            }
        }
    }
}
