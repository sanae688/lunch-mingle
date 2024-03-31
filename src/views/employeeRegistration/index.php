<?php
?>
<div class="content">
    <h2>従業員登録</h2>
    <form action="/employeeRegistration/create" method="post">
        <label for="employeeId">従業員ID：</label>
        <input type="number" min="1" id="employeeId" name="employeeId" value="<?php echo $employeeId; ?>" required>
        <label for="employeeName">従業員名：</label>
        <input type="text" id="employeeName" name="employeeName" value="<?php echo $employeeName; ?>" required>
        <button type="submit">登録</button>
    </form>
</div>

<?php if (!empty($alerts)) : ?>
    <div class="content">
        <?php foreach ($alerts as $alert) : ?>
            <b class="alert">
                <?php echo $alert; ?>
            </b>
            <br>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<div class="content">
    <h2>従業員一覧</h2>
    <?php if (!empty($employees)) : ?>
        <?php foreach ($employees as $employee) : ?>
            <p>
                <label for="employeeId">従業員ID：</label>
                <?php echo $employee['employee_id']; ?>
                &nbsp;&nbsp;
                <label for="employeeName">従業員名：</label>
                <?php echo $employee['employee_name']; ?>
            </p>
        <?php endforeach; ?>
    <?php else : ?>
        <b class="alert">
            ※従業員が存在してません。従業員を登録して下さい。
        </b>
    <?php endif; ?>
</div>
