<?php

/**
 * 従業員登録コントローラー
 *
 * @author naito
 * @version ver1.0.0 2024/03/23
 */
class EmployeeRegistrationController extends Controller
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
            'title' => '従業員登録',
            'employees' => $employees,
            'alerts' => [],
            'employeeId' => '',
            'employeeName' => '',
        ]);
    }

    /**
     * 従業員登録
     *
     * @return string|false ビュー情報
     * @throws HttpBadRequestException 400エラー
     */
    public function create(): string|false
    {
        if (!$this->request->isPost()) {
            throw new HttpBadRequestException();
        }

        $employees = [];
        $alerts = [];
        $employeeId = '';
        $employeeName = '';

        $employee = $this->databaseManager->get('Employee');

        $count = $employee->fetchAllCountEmployeeId($_POST['employeeId']);
        if (!($count[0]['count'] === 0)) {
            $alerts['employeeId'] = '※従業員IDが重複してます。他の従業員IDを入力して下さい。';
        }

        $escapeEmployeeName = htmlspecialchars($_POST['employeeName'], ENT_QUOTES);
        if (strlen($escapeEmployeeName) > 100) {
            $alerts['employeeName'] = '※従業員名は100字以内で入力して下さい。';
        }

        if (empty($alerts)) {
            $createStatus = $employee->insert($_POST['employeeId'], $escapeEmployeeName);
            if ($createStatus === Status::ERROR) {
                $alerts['create'] = '※従業員登録に失敗しました。再度登録して下さい。';
            }
        }

        if (!empty($alerts)) {
            $employeeId = $_POST['employeeId'];
            $employeeName = $escapeEmployeeName;
        }

        $employees = $employee->fetchAllEmployee();

        return $this->render([
            'title' => '従業員登録',
            'employees' => $employees,
            'alerts' => $alerts,
            'employeeId' => $employeeId,
            'employeeName' => $employeeName,
        ], 'index');
    }
}
