<!doctype html>
<html lang="<?= $lang ?>">

<head>
    <!-- Required meta tags -->
    <meta charset="<?= $charset ?>">
    <meta name="viewport" content="<?= $viewport ?>">

    <!-- Favicon -->
    <link rel="FaviconIcon" href="<?= HTTP_IMAGES ?>logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= HTTP_IMAGES ?>logo.png" type="image/x-icon" />

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- CSS Files -->
    <?php foreach ($css as $_css) { ?>
        <link rel="stylesheet" href="<?= HTTP_ASSET_PATH . $_css ?>">
    <?php } ?>

    <!-- Meta Data -->
    <?php foreach ($metadata as $_key => $_value) : ?>
        <meta name="<?= $_key ?>" content="<?= $_value ?>" />
        <meta property="og:<?= $_key ?>" content="<?= $_value ?>" />
    <?php endforeach; ?>

    <!-- Theme Color -->
    <meta name="theme-color" content="<?= $theme_color ?>" />
    <meta name="msapplication-navbutton-color" content="<?= $theme_color ?>">
    <meta name="apple-mobile-web-app-status-bar-style" content="<?= $theme_color ?>">

    <!-- SEO Optimization -->
    <meta name="robots" content="<?= $seo_robots ?>" />
    <!-- CSRF Parameters -->
    <meta name="csrf-param" content="authenticity_token" />

    <title><?= $title ?></title>
</head>

<body>
    <header>
        <!-- Header Here !! -->        
    </header>