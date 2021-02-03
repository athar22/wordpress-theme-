<?php
if ( !is_user_logged_in() &&  !is_page('login')) {
    wp_redirect( home_url().'/login');
    exit;
}


?>
<!DOCTYPE html>
<html class="desktop" lang="en">
<head>
    <!-- Title -->
    <title>EBA Members Directory</title>

    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

    <meta itemprop="name" content="" />
    <meta itemprop="description" content="" />
    <meta itemprop="image" content="" />

    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:type" content="website" />

    <!-- Favicons -->
    <link
        rel="apple-touch-icon"
        sizes="57x57"
        href="<?php bloginfo('template_directory') ;?>/assets/images/favicons/apple-icon-57x57.png"
        />
    <link
        rel="apple-touch-icon"
        sizes="60x60"
        href="<?php bloginfo('template_directory') ;?>/assets/images/favicons/apple-icon-60x60.png"
        />
    <link
        rel="apple-touch-icon"
        sizes="72x72"
        href="<?php bloginfo('template_directory') ;?>/assets/images/favicons/apple-icon-72x72.png"
        />
    <link
        rel="apple-touch-icon"
        sizes="76x76"
        href="<?php bloginfo('template_directory') ;?>/assets/images/favicons/apple-icon-76x76.png"
        />
    <link
        rel="apple-touch-icon"
        sizes="114x114"
        href="<?php bloginfo('template_directory') ;?>/assets/images/favicons/apple-icon-114x114.png"
        />
    <link
        rel="apple-touch-icon"
        sizes="120x120"
        href="<?php bloginfo('template_directory') ;?>/assets/images/favicons/apple-icon-120x120.png"
        />
    <link
        rel="apple-touch-icon"
        sizes="144x144"
        href="<?php bloginfo('template_directory') ;?>/assets/images/favicons/apple-icon-144x144.png"
        />
    <link
        rel="apple-touch-icon"
        sizes="152x152"
        href="<?php bloginfo('template_directory') ;?>/assets/images/favicons/apple-icon-152x152.png"
        />
    <link
        rel="apple-touch-icon"
        sizes="180x180"
        href="<?php bloginfo('template_directory') ;?>/assets/images/favicons/apple-icon-180x180.png"
        />
    <link
        rel="icon"
        type="image/png"
        sizes="192x192"
        href="<?php bloginfo('template_directory') ;?>/assets/images/favicons/android-icon-192x192.png"
        />
    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="<?php bloginfo('template_directory') ;?>/assets/images/favicons/favicon-32x32.png"
        />
    <link
        rel="icon"
        type="image/png"
        sizes="96x96"
        href="<?php bloginfo('template_directory') ;?>/assets/images/favicons/favicon-96x96.png"
        />
    <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="<?php bloginfo('template_directory') ;?>/assets/images/favicons/favicon-16x16.png"
        />
    <link rel="manifest" href="<?php bloginfo('template_directory') ;?>/assets/images/favicons/manifest.json" />
    <meta name="msapplication-TileColor" content="#0A3D80" />
    <meta
        name="msapplication-TileImage"
        content="<?php bloginfo('template_directory') ;?>/assets/images/favicons/ms-icon-144x144.png"
        />
    <meta name="theme-color" content="#0A3D80" />
    <style media="print">
.noPrint { display:none}
</style>
    <!-- Fonts and Material Icons -->
    <!-- webfont -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/webfont/1.6.28/webfontloader.js"
        crossorigin="anonymous"
        name="webfont-scripts"
        async
        ></script>
    <script>
        WebFontConfig = {
            google: {
                families: ["Work Sans:300,400,500,600", "Cairo:300,400,500,600"],
            },
            timeout: 2000, // Set the timeout to two seconds
        };
    </script>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="<?php bloginfo('template_directory') ;?>/assets/fonts/fontawesome/all.css" />

    <!-- Bootstrap 4.5.2 -->
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
        crossorigin="anonymous"
        />

    <!-- EBA Styles -->
    <link href="<?php bloginfo('template_directory') ;?>/assets/css/style.css" rel="stylesheet" type="text/css" />
    <?php wp_head();?>
</head>

<body>

<?php get_template_part('content', 'navbar'); ?>

