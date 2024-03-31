<?php

/**
 * 従業員更新コントローラー
 *
 * @author naito
 * @version ver1.0.0 2024/03/23
 */
class EmployeeUpdateController extends Controller
{
    /**
     * 初期表示
     *
     * @return string|false ビュー情報
     */
    public function index(): string|false
    {
        $employees = $this->databaseManager->get('Employee')->fetchAllEmployee();

        return $this->render([
            'title' => '従業員更新',
            'employees' => $employees,
            'alerts' => [],
        ]);
    }

    /**
     * 従業員更新
     *
     * @return string|false ビュー情報
     * @throws HttpNotFoundException 404エラー
     */
    public function update(): string|false
    {
        if (!$this->request->isPost()) {
            throw new HttpNotFoundException();
        }

        $employees = [];
        $alerts = [];

        $employee = $this->databaseManager->get('Employee');

        $count = $employee->fetchAllCountEmployeeId($_POST['employeeId']);
        if (!($count[0]['count'] === 0) && !($_POST['employeeId'] === $_POST['oldEmployeeId'])) {
            $alerts['employeeId'] = '※従業員IDが重複してます。他の従業員IDを入力して下さい。';
        }

        if (strlen($_POST['employeeName']) > 100) {
            $alerts['employeeName'] = '※従業員名は100字以内で入力して下さい。';
        }

        if (empty($alerts)) {
            $updateStatus = $employee->update($_POST['employeeId'], $_POST['employeeName'], $_POST['oldEmployeeId']);
            if ($updateStatus === Status::ERROR) {
                $alerts['update'] = '※従業員更新に失敗しました。再度更新して下さい。';
            }
        }

        $employees = $employee->fetchAllEmployee();

        return $this->render([
            'title' => '従業員更新',
            'employees' => $employees,
            'alerts' => $alerts,
        ], 'index');
    }
}
