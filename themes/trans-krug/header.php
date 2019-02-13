<!doctype html>
<html lang="<? bloginfo('language') ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= wp_get_document_title() ?></title>
    <link rel="apple-touch-icon" sizes="120x120" href="<?= path() ?>assets/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= path() ?>assets/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= path() ?>assets/img/favicon/favicon-16x16.png">
    <link rel="manifest" href="<?= path() ?>assets/img/favicon/site.webmanifest">
    <link rel="mask-icon" href="safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
	<? wp_head() ?>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <? the_field('метрики_в_хедере','common') ?>
</head>
<body <? body_class() ?>>
<header class="header">
	<? if ( is_front_page() ): ?>
        <img data-lazysrc="<?= path() ?>assets/img/logo-1.png" alt="" class="logo-ani wow rollIn d-none d-md-block" data-wow-delay="2s"
             data-wow-duration="2s">
        <img data-lazysrc="<?= path() ?>assets/img/logo-1_mob.png" alt="" class="logo-ani d-block d-md-none">
	<? endif; ?>
    <div class="header-container">
        <div class="container-lg container">
            <a href="<? bloginfo('url') ?>"><img src="<?= path() ?>assets/img/logo_animated.svg" width="156" height="51"
                            class="img-fluid logo wow slideInLeft" data-wow-duration="2s" data-wow-offset="0"
                            alt=""></a>
            <nav class="menu-container" role="navigation">
				<? wp_nav_menu( [
					'theme_location'  => 'header_menu',
					'container'  => null,
					'items_wrap' => '<ul class="menu wow slideInRight" data-wow-duration="2s">%3$s</ul>',
					'walker'     => new WP_Bootstrap_Navwalker()
				] );
				?>
            </nav>
            <button id="mobile-menu" class="mobile-btn"><span></span><span></span><span></span></button>
        </div>
    </div>
</header>
<? if ( !is_front_page() ): ?>
<div class="container container-lg decor-top-line">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
	        <? bcn_display(); ?>
        </ol>
    </nav>
</div>
<? endif; ?>
<main class="content" role="main">