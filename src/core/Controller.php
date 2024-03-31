<?php

/**
 * コントローラークラス
 *
 * @author naito
 * @version ver1.0.0 2024/03/23
 */
class Controller
{
    /* @var string メソッド名 */
    protected string $actionName;

    /* @var Request リクエスト */
    protected Request $request;

    /* @var DatabaseManager データベースマネージャー */
    protected DatabaseManager $databaseManager;

    /**
     * コンストラクタ
     *
     * @param Application $application アプリケーション
     */
    public function __construct($application)
    {
        $this->request = $application->getRequest();
        $this->databaseManager = $application->getDatabaseManager();
    }

    /**
     * 処理実行
     *
     * @param string $action メソッド名
     * @return string コンテンツ
     * @throws HttpNotFoundException 404エラー
     */
    public function run($action): string
    {
        $this->actionName = $action;

        if (!method_exists($this, $action)) {
            throw new HttpNotFoundException();
        }

        $content = $this->$action();
        return $content;
    }

    /**
     * 画面読み込み
     *
     * @param array<mixed> $variables 変数
     * @param string $template 部品
     * @param string $layout レイアウト
     * @return string レイアウト情報
     */
    protected function render($variables = [], $template = null, $layout = 'layout'): string
    {
        $view = new View(dirname(__FILE__, 2) . '/views');

        if (is_null($template)) {
            $template = $this->actionName;
        }
        $controllerName = lcfirst(substr(get_class($this), 0, -10));
        $path = $controllerName . '/' . $template;
        return $view->render($path, $variables, $layout);
    }
}
