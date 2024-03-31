<?php
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php if (isset($title)) : echo $title . '-';
        endif; ?>シャッフルランチ
    </title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }

        h1 {
            color: #007bff;
        }

        .content {
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:disabled {
            color: #808080;
            background-color: #C0C0C0;
        }

        button:disabled:hover {
            color: #808080;
            background-color: #C0C0C0;
        }

        button:hover {
            background-color: #0056b3;
        }

        .alert {
            color: red;
        }
    </style>
</head>

<body>
    <h1>
        <a href="/employeeShuffle">シャッフルランチサービス</a>
    </h1>

    <div class="content">
        <?php echo $content; ?>
    </div>
</body>

</html>
