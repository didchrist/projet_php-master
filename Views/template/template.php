<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bases - POO - MVC</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/index.css">
    <?php if ($page === 'homepage') : ?>
    <link rel="stylesheet" href="../../assets/css/articles.css">
    <?php elseif ($page === 'add-article') : ?>
    <link rel="stylesheet" href="../../assets/css/add-article.css">
    <?php endif; ?>
</head>

<body>

    <div class="container">
        <?= $content ?>
    </div>

</body>

</html>