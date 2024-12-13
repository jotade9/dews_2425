<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= $this->title;?>
    <?= var_dump($this->alumnos->fetchAll()); ?>
</body>
</html>