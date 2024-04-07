<?php
?>
<div class="content">
    <h2>従業員登録</h2>
    <form action="/employeeRegistration" method="post">
        <button type="submit">従業員登録</button>
    </form>
    <h2>従業員更新</h2>
    <form action="/employeeUpdate" method="post">
        <button type="submit">従業員更新</button>
    </form>
</div>

<div class="content">
    <h2>ランチメンバーシャッフル</h2>
    <form name="create" action="/employeeShuffle/create" method="post">
        <button type="submit" name="submit">シャッフルする</button>
    </form>
</div>

<div class="content">
    <h2>ランチグループ</h2>
    <?php if (!empty($employeeShuffleGroups)) : ?>
        <?php foreach ($employeeShuffleGroups as $i => $employeeShuffleGroup) : ?>
            <h3>グループ<?php echo ($i + 1); ?></h3>
            <p>
                <?php foreach ($employeeShuffleGroup as $employee) : ?>
                    <?php echo $employee['employee_name']; ?>&nbsp;&nbsp;
                <?php endforeach; ?>
            </p>
        <?php endforeach; ?>
    <?php elseif (empty($employees)) : ?>
        <b class="alert">
            ※従業員が存在してません。従業員を登録して下さい。
        </b>
    <?php else : ?>
        <b class="alert">
            ※シャッフルして下さい。
        </b>
    <?php endif; ?>
</div>

<script>
    window.onload = function() {
        <?php if (empty($employees)) : ?>
            var elementButton = document.forms.create;
            elementButton.submit.disabled = true;
        <?php endif; ?>
    }
</script>
