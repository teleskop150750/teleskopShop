<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ошибка</title>
</head>

<body>

    <h1>Произошла ошибка</h1>
    <p>
        <b>Код ошибки:</b> <?= $errorNumber ?>
    </p>
    <p><b>Текст ошибки:</b> <?= $text ?></p>
    <p><b>Файл, в котором произошла ошибка:</b> <?= $file ?></p>
    <p><b>Строка, в которой произошла ошибка:</b> <?= $line ?></p>

</body>

</html>