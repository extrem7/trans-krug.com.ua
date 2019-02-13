<?
$isBlue  = is_front_page();
$classes = is_single() ? 'decor-both-line-after-footer base-section' : 'section-sm-indent';
$path = "";
?>
<section class="reviews-section <?= $classes ?> <?= $isBlue ? 'blue-gradient' : '' ?> wow fadeIn" data-wow-delay="1s"
         data-wow-duration="2s">
    <div class="container">
		<? if ( is_single() ): ?>
            <div class="title-main text-center"><? pll_e( 'Отзывы наших клиентов' ) ?></div>
		<? endif ?>
        <div class="owl-carousel owl-theme <?= ! $isBlue ? 'dots-dark' : '' ?>" id="reviews">
			<?
			$reviews = get_field( 'отзывы', pll_get_post( 19 ) );
			foreach ( $reviews as $review ):
				if ( ! $review['отображать_на_главной'] ) {
					continue;
				}
				$img = $review['логотип'];
				?>
                <div>
                    <div class="review text-center">
                        <div class="review-q"><? $isBlue ? $path='assets/img/icon_quote.png' : $path = 'assets/img/icon_quote_black.png' ?><img src="<?= path().$path ?>" alt="iconquote"></div>
                        <div class="title-second large-size text-center"><?= $review['заголовок'] ?></div>
                        <div class="description"><?= $review['текст'] ?></div>
                        <div class="review-author flex-column flex-sm-row">
                            <img src="<?= $img['url'] ?>" class="img-fluid mb-2 mb-sm-0" alt="<?= $img['alt'] ?>">
                            <div>
								<?= $review['имя'] ?>
								<? if ( $review['скан'] ): ?>
                                    <a class="d-block" data-fancybox="gallery"
                                       href="<?= $review['скан'] ?>"><? pll_e( 'Посмотреть копию-скан отзыва' ) ?></a>
								<? endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
			<? endforeach; ?>
        </div>
    </div>
</section>