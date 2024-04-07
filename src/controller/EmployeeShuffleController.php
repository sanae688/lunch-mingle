<?php

/**
 * 従業員シャッフルコントローラー
 *
 * @author naito
 * @version ver1.0.0 2024/03/23
 */
class EmployeeShuffleController extends Controller
{
    /**
     * 初期表示
     *
     * @return string|false ビュー情報
     */
    public function index(): string|false
    {
        $employeeShuffleGroups = [];
        $employees = [];

        $employees = $this->databaseManager->get('Employee')->fetchAllEmployee();

        return $this->render([
            'employeeShuffleGroups' => $employeeShuffleGroups,
            'employees' => $employees,
        ]);
    }

    /**
     * ランチグループ作成
     *
     * @return string|false ビュー情報
     * @throws HttpBadRequestException 400エラー
     */
    public function create(): string|false
    {
        if (!$this->request->isPost()) {
            throw new HttpBadRequestException();
        }

        $employeeShuffleGroups = [];
        $employees = [];

        $employees = $this->databaseManager->get('Employee')->fetchAllNames();

        if (!empty($employees)) {
            shuffle($employees);
            if (count($employees) === 1) {
                $employeeShuffleGroups[0] = $employees;
            } elseif (count($employees) % 2 === 0) {
                $employeeShuffleGroups = array_chunk($employees, 2);
            } else {
                $extra = array_pop($employees);
                $employeeShuffleGroups = array_chunk($employees, 2);
                array_push($employeeShuffleGroups[0], $extra);
            }
        }

        return $this->render([
            'employeeShuffleGroups' => $employeeShuffleGroups,
            'employees' => $employees,
        ], 'index');
    }
}
