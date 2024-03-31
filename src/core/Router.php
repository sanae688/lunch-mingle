<?php

/**
 * ルータークラス
 *
 * @author naito
 * @version ver1.0.0 2024/03/23
 */
class Router
{
    /**
     * コンストラクタ
     *
     * @param array<mixed> $routes ルート
     */
    public function __construct(private array $routes)
    {
    }

    /**
     * 処理パターン取得
     *
     * @param string $pathInfo パス情報
     * @return array<mixed>|Status 処理パターン
     */
    public function getResolve($pathInfo): array|Status
    {
        foreach ($this->routes as $path => $pattern) {
            if ($path === $pathInfo) {
                return $pattern;
            }
        }

        return Status::ERROR;
    }
}
