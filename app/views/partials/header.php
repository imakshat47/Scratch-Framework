<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicon -->
    <link rel="FaviconIcon" href="<?= Images ?>logo.png" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= Images ?>logo.png" type="image/x-icon" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(Css . 'bootstrap.min.css') ?>">
    <!-- Custome CSS -->
    <link rel="stylesheet" href="<?= base_url(Css . 'style.css') ?>">

    <!-- Meta Data -->
    <?php if (isset($metadata)) : ?>
        <meta name="name" content="<?= empty($matadata['name']) ? " " : $matadata['name'] ?>" />
        <meta name="title" content="<?= $title ?>" />
        <meta name="description" content="<?= empty($matadata['description']) ? " " : $matadata['description'] ?>" />
        <meta name="keywords" content="<?= empty($matadata['keywords']) ? " " : $matadata['keywords'] ?>" />

        <!-- Meta Property -->
        <?php if (isset($og_data)) { ?>
            <meta property="og:title" content="<?= $title ?>" />
            <meta property="og:type" content="website" />
            <meta property="og:url" content="<?= empty($og_data['url']) ? base_url() : $og_data['url'] ?>" />
            <meta property="og:site_name" content="<?= empty($og_data['name']) ? $matadata['name'] : $og_data['name'] ?>" />
            <meta property="og:description" content="<?= empty($og_data['description']) ? $matadata['description'] : $og_data['description'] ?>" />
    <?php }
    endif; ?>
    <!-- Theme Color -->
    <meta name="theme-color" content="#000" />
    <meta name="msapplication-navbutton-color" content="#000">
    <meta name="apple-mobile-web-app-status-bar-style" content="#000">

    <!-- SEO Optimization -->
    <meta name="robots" content="index, follow" />
    <meta name="csrf-param" content="authenticity_token" />

    <title><?= $title ?></title>
</head>

<body>

    <header class="navbar navbar-expand-lg navbar-light bg-blue border-bottom sticky-top">
        <nav class="container p-2">
            <div class="col-sm-12 col-lg-2">
                <a class="navbar-brand  color-white" href="<?= base_url() ?>"><img src="<?= Images ?>logo.png" height="25px" width="25px" alt="barnd Logo"><b> Scratch</b></a>
            </div>

            <ul class="col-sm-12 col-lg-8 nav">
                <li class="nav-item active">
                    <a class="nav-link color-white" href="<?= base_url('Home') ?>">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link color-white" href="<?= base_url() ?>">User Guide</a>
                </li>
                <li class="nav-item  d-none d-md-block">
                    <a class="nav-link color-white" href="<?= base_url('examples/Services/') ?>">Examples</a>
                </li>
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link color-white" href="#">Themes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link color-white" href="#">Blog</a>
                </li>
            </ul>

            <ul class="col-sm-12 col-lg-2 nav">
                <li class="nav-item dropdown">
                    <a class="nav-link color-white dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        v1.0
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">v2.0</a>
                        <a class="dropdown-item" href="#">v3.0</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url() ?>">All Version</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link color-white" href="#">G</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link color-white" href="#">O </a>
                </li>
            </ul>
        </nav>
    </header>