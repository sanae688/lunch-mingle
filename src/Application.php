<?php

/**
 * アプリケーションクラス
 *
 * @author naito
 * @version ver1.0.0 2024/03/23
 */
class Application
{

    /* @var Request リクエスト */
    protected Request $request;

    /* @var Router ルーター */
    protected Router $router;

    /* @var Response レスポンス */
    protected Response $response;

    /* @var DatabaseManager データベースマネージャー */
    protected DatabaseManager $databaseManager;

    public function __construct()
    {
        $this->router = new Router($this->registerRoutes());
        $this->response = new Response();
        $this->request = new Request();
        $this->databaseManager = new DatabaseManager();
    }

    /**
     * 処理実行
     *
     * @throws HttpNotFoundException 404エラー
     */
    public function run(): void
    {
        try {
            $this->databaseManager->dbConnect();

            $params = $this->router->getResolve($this->request->getPathInfo());
            if ($params === Status::ERROR) {
                throw new HttpNotFoundException();
            }

            $controller = $params['controller'];
            $action = $params['action'];
            $this->runAction($controller, $action);
        } catch (HttpBadRequestException) {
            $this->render400Page();
        } catch (HttpNotFoundException) {
            $this->render404Page();
        } catch (PDOException) {
            $this->render500Page();
        } finally {
            $this->response->send();
        }
    }

    /**
     * リクエスト取得
     *
     * @return Request リクエスト
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * データベースマネージャー取得
     *
     * @return DatabaseManager データベースマネージャー
     */
    public function getDatabaseManager(): DatabaseManager
    {
        return $this->databaseManager;
    }

    /**
     * メソッド実行
     *
     * @param string $controllerName コントローラー名
     * @param string $action メソッド名
     * @throws HttpNotFoundException 404エラー
     */
    private function runAction(string $controllerName, string $action): void
    {
        $controllerClass = ucfirst($controllerName) . 'Controller';
        if (!class_exists($controllerClass)) {
            throw new HttpNotFoundException();
        }
        $controller = new $controllerClass($this);
        $content = $controller->run($action);
        $this->response->setContent($content);
        $this->response->setStatusCode(200, 'OK');
    }

    /**
     * ルート登録
     *
     * @param string $controllerName コントローラー名
     * @return array<mixed> ルート
     */
    private function registerRoutes(): array
    {
        return [
            '/employeeShuffle' => ['controller' => 'employeeShuffle', 'action' => 'index'],
            '/employeeShuffle/create' => ['controller' => 'employeeShuffle', 'action' => 'create'],
            '/employeeRegistration' => ['controller' => 'employeeRegistration', 'action' => 'index'],
            '/employeeRegistration/create' => ['controller' => 'employeeRegistration', 'action' => 'create'],
            '/employeeUpdate' => ['controller' => 'employeeUpdate', 'action' => 'index'],
            '/employeeUpdate/update' => ['controller' => 'employeeUpdate', 'action' => 'update'],
        ];
    }

    /**
     * 400エラー画面呼び出し
     */
    private function render400Page(): void
    {
        $this->response->setStatusCode(400, 'Bad Request');
        $this->response->setContent(__DIR__ . '/views/error/400BadRequestError.php');
    }

    /**
     * 404エラー画面呼び出し
     */
    private function render404Page(): void
    {
        $this->response->setStatusCode(404, 'Not Found');
        $this->response->setContent(__DIR__ . '/views/error/404NotFoundError.php');
    }

    /**
     * 500エラー画面呼び出し
     */
    private function render500Page(): void
    {
        $this->response->setStatusCode(500, 'Internal Server');
        $this->response->setContent(__DIR__ . '/views/error/500InternalServerError.php');
    }
}
