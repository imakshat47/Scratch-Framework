<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            background-color: #f1f1f1;
            text-align: center;
        }

        img {
            max-width: 100%;
            height: auto;
            align-items: center;
            align-self: center;
        }

        button {
            font-size: 1.5rem;
            font-weight: bolder;
        }

        a {
            color: orange;
        }
    </style>

    <title><?= isset($title) ? $title : "404 | Page Not Found" ?></title>
</head>

<body>
    <div>
        <h1>
            <br>
            <?= isset($msg) ? $msg : '' ?>
        </h1>
        <img src="<?= HTTP_IMAGES .  '_404.png' ?>" alt="404 Page Not Found">
    </div>
    <a href="<?= base_url() ?>">
        <button style="color: brown;border-color: orange;">
            <b>Go to <i> Home</i></b>
        </button>
    </a>
</body>

</html>