<?php

/**
 * 従業員クラス
 *
 * @author naito
 * @version ver1.0.0 2024/03/23
 */
class Employee extends DatabaseModel
{
    /**
     * 従業員名取得
     *
     * @return array<mixed> 取得結果
     */
    public function fetchAllNames(): array
    {
        return $this->fetchAll('SELECT employee_name FROM employees ORDER BY reg_time;');
    }

    /**
     * 従業員取得
     *
     * @return array<mixed> 取得結果
     */
    public function fetchAllEmployee(): array
    {
        return $this->fetchAll('SELECT employee_id, employee_name FROM employees ORDER BY reg_time;');
    }

    /**
     * 従業員ID重複確認
     *
     * @param int $inputEmployeeId 従業員ID
     * @return array<mixed> 取得結果
     */
    public function fetchAllCountEmployeeId(int $inputEmployeeId): array
    {
        $sql = <<<EOI
            SELECT
                COUNT(employee_id) AS count
            FROM
                employees
            WHERE
                employee_id = ?
            EOI;

        return $this->fetchAll($sql, [$inputEmployeeId]);
    }

    /**
     * 従業員登録
     *
     * @param int $inputEmployeeId 従業員ID
     * @param string $inputEmployeeName 従業員名
     * @return Status 登録結果
     */
    public function insert(int $inputEmployeeId, string $inputEmployeeName): Status
    {
        $sql = <<<EOI
            INSERT
            INTO employees(employee_id, employee_name, reg_time, up_time)
            VALUES (?, ?, NOW(), NOW());
            EOI;

        return $this->execute($sql, [$inputEmployeeId, $inputEmployeeName]);
    }

    /**
     * 従業員更新
     *
     * @param int $inputEmployeeId 従業員ID
     * @param string $inputEmployeeName 従業員名
     * @param int $oldEmployeeId 従業員ID
     * @return Status 登録結果
     */
    public function update(int $inputEmployeeId, string $inputEmployeeName, int $oldEmployeeId): Status
    {
        $sql = <<<EOI
            UPDATE employees
            SET
                employee_id = ?
                , employee_name = ?
                , up_time = NOW()
            WHERE
                employee_id = ?;
            EOI;

        return $this->execute($sql, [$inputEmployeeId, $inputEmployeeName, $oldEmployeeId]);
    }
}
