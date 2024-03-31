<?php
?>
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
    <h2>従業員更新</h2>
    <?php if (!empty($employees)) : ?>
        <form name="update" action="/employeeUpdate/update" method="post">
            <?php foreach ($employees as $i => $employee) : ?>
                <p>
                    <input type="checkbox" id="employee<?php echo $i + 1; ?>" name="employee<?php echo $i + 1; ?>" />
                    <label for="employeeId">従業員ID：</label>
                    <input type="number" min="1" id="employeeId<?php echo $i + 1; ?>" name="employeeId" value="<?php echo $employee['employee_id']; ?>" disabled required>
                    &nbsp;&nbsp;
                    <label for="employeeName">従業員名：</label>
                    <input type="text" id="employeeName<?php echo $i + 1; ?>" name="employeeName" value="<?php echo $employee['employee_name']; ?>" disabled required>
                    <input type="hidden" id="oldEmployeeId<?php echo $i + 1; ?>" name="oldEmployeeId" value="<?php echo $employee['employee_id']; ?>" disabled>
                </p>
            <?php endforeach; ?>
            <button type="submit" name="submit" disabled>更新</button>
        </form>
    <?php else : ?>
        <b class="alert">
            ※従業員が存在してません。従業員を登録して下さい。
        </b>
        <form action="/employeeRegistration" method="post">
            <button type="submit">従業員登録</button>
        </form>
    <?php endif; ?>
</div>

<script>
    window.onload = function() {
        <?php foreach ($employees as $i => $employee) : ?>
            var elementCheck<?php echo $i + 1; ?> = document.getElementById('employee<?php echo $i + 1; ?>');
            var elementId<?php echo $i + 1; ?> = document.getElementById('employeeId<?php echo $i + 1; ?>');
            var elementName<?php echo $i + 1; ?> = document.getElementById('employeeName<?php echo $i + 1; ?>');
            var elementOldId<?php echo $i + 1; ?> = document.getElementById('oldEmployeeId<?php echo $i + 1; ?>');
            var elementButton = document.forms.update;
            elementCheck<?php echo $i + 1; ?>.addEventListener('input', function() {
                if (elementCheck<?php echo $i + 1; ?>.checked) {
                    elementId<?php echo $i + 1; ?>.disabled = false;
                    elementName<?php echo $i + 1; ?>.disabled = false;
                    elementOldId<?php echo $i + 1; ?>.disabled = false;
                    elementButton.submit.disabled = false;
                    <?php foreach ($employees as $i => $employee) : ?>
                        var elementCheckUpdate<?php echo $i + 1; ?> = document.getElementById('employee<?php echo $i + 1; ?>');
                        if (!elementCheckUpdate<?php echo $i + 1; ?>.checked) {
                            elementCheckUpdate<?php echo $i + 1; ?>.disabled = true;
                        }
                    <?php endforeach; ?>
                } else {
                    elementButton.submit.disabled = true;
                    <?php foreach ($employees as $i => $employee) : ?>
                        var elementCheckInit<?php echo $i + 1; ?> = document.getElementById('employee<?php echo $i + 1; ?>');
                        var elementIdInit<?php echo $i + 1; ?> = document.getElementById('employeeId<?php echo $i + 1; ?>');
                        var elementNameInit<?php echo $i + 1; ?> = document.getElementById('employeeName<?php echo $i + 1; ?>');
                        var elementOldIdInit<?php echo $i + 1; ?> = document.getElementById('oldEmployeeId<?php echo $i + 1; ?>');
                        elementCheckInit<?php echo $i + 1; ?>.disabled = false;
                        elementIdInit<?php echo $i + 1; ?>.disabled = true;
                        elementNameInit<?php echo $i + 1; ?>.disabled = true;
                        elementOldIdInit<?php echo $i + 1; ?>.disabled = true;
                    <?php endforeach; ?>
                }
            })
        <?php endforeach; ?>
    }
</script>
