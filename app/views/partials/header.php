<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="FaviconIcon" href="<?= HTTP_IMAGES ?>logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= HTTP_IMAGES ?>logo.png" type="image/x-icon" />

    <!-- Custome CSS  -->
    <link rel="stylesheet" href="<?= HTTP_ASSET_PATH ?>css/style.css">

    <!-- Meta Data -->
    <?php if (isset($metadata)) : ?>
        <meta name="name" content="<?= empty($metadata['name']) ? " " : $metadata['name'] ?>" />
        <meta name="title" content="<?= $title ?>" />
        <meta name="description" content="<?= empty($metadata['description']) ? " " : $metadata['description'] ?>" />
        <meta name="keywords" content="<?= empty($metadata['keywords']) ? " " : $metadata['keywords'] ?>" />

        <!-- Meta Property -->
        <?php if (isset($og_data)) { ?>
            <meta property="og:title" content="<?= $title ?>" />
            <meta property="og:type" content="website" />
            <meta property="og:url" content="<?= empty($og_data['url']) ? base_url() : $og_data['url'] ?>" />
            <meta property="og:site_name" content="<?= empty($og_data['name']) ? $metadata['name'] : $og_data['name'] ?>" />
            <meta property="og:description" content="<?= empty($og_data['description']) ? $metadata['description'] : $og_data['description'] ?>" />
    <?php }
    endif; ?>

    <!-- Theme Color -->
    <meta name="theme-color" content="#000" />
    <meta name="msapplication-navbutton-color" content="#000">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">

    <!-- SEO Optimization -->
    <meta name="robots" content="index, follow" />
    <!-- CSRF Parameters -->
    <meta name="csrf-param" content="authenticity_token" />

    <title><?= $title ?></title>
</head>

<body>