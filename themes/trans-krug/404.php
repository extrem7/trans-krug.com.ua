<? get_header();
global $lang;
?>
    <div class="container">
        <div class="error-page text-center">
            <img src="<?= path() ?>assets/img/icons/404.svg" alt="">
            <div class="title-main text-center">404</div>
            <div class="text-center">
				<? pll_e( 'Запрашиваемая вами страница не найдена.' ) ?> <br>
				<? if ( $lang == 'ru' ): ?>
                    Вернитесь <a href="<?= $_SERVER['HTTP_REFERER'] ?? get_home_url() ?>">назад</a> или перейдите на <a
                            href="<? bloginfo( 'url' ) ?>">главную.</a>
				<? else: ?>
                    Поверніться <a href="<?= $_SERVER['HTTP_REFERER'] ?? get_home_url() ?>">назад</a> або перейдіть на <a
                            href="<? bloginfo( 'url' ) ?>">головну.</a>
				<? endif; ?>
            </div>
        </div>
    </div>
<? get_footer(); ?>