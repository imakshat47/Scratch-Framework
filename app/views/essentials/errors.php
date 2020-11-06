<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            background-color: #fff;
            text-align: center;
        }

        img {
            max-width: 80%;
            height: 80vh;
            align-items: center;
            align-self: center;
        }

        button {
            font-size: 1.5rem;
            font-weight: bolder;
        }

        .text-left {
            text-align: left;
            margin-left: 3rem;
        }
    </style>

    <title><?= $title ?></title>
</head>

<body>
    <h2 class="text-left">
        <?= $msg ?>
    </h2>
    <div>
        <img src="<?= HTTP_IMAGES .  'error.png' ?>" alt="404 Page Not Found">
    </div>
</body>

</html>