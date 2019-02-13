<?
/* Template Name: Отзывы */
get_header();
global $lang;
?>
    <div class="container wow fadeInUp" data-wow-duration="2s">
        <div class="title-main text-center"><? the_title() ?></div>
        <div class="sub-title text-center"><?= apply_filters( 'the_content', wpautop( get_post_field( 'post_content', $id ), true ) ); ?></div>
        <div class="owl-carousel owl-theme mt-5 owl-number" id="reviews-page">
			<?
			$reviews = get_field( 'отзывы' );
			$reviews = array_chunk( $reviews, 6 );
			foreach ( $reviews as $row ):
				?>
                <div>
                    <div class="row">
						<?
                        $columns = [];
						if ( count( $row ) > 1 ) {
							$columns = array_chunk( $row, ceil( count( $row ) ) / 2 );
						} else {
						    $columns[] = $row;
                        }
						foreach ( $columns as $column ):
							?>
                            <div class="col-md-6">
								<? foreach ( $column as $review ):
									$img = $review['логотип'];
									?>
                                    <div class="review">
                                        <div class="review-q"><img src="<?= path() ?>assets/img/icon_quote_black.png" alt=""></div>
                                        <div class="title-second medium-size"><?= $review['заголовок'] ?></div>
                                        <div class="description"><?= $review['текст'] ?></div>
                                        <div class="review-author flex-column flex-sm-row">
                                            <img src="<?= $img['url'] ?>" class="img-fluid" alt="<?= $img['alt'] ?>">
                                            <div>
												<?= $review['имя'] ?>
												<? if ( $review['скан'] ): ?>
                                                    <a data-fancybox="gallery" href="<?= $review['скан'] ?>"
                                                       class="d-block"><? pll_e( 'Посмотреть копию-скан отзыва' ) ?></a>
												<? endif; ?>
                                            </div>
                                        </div>
                                    </div>
								<? endforeach; ?>
                            </div>
						<? endforeach; ?>
                    </div>
                </div>
			<? endforeach; ?>
        </div>
    </div>
<? get_footer() ?>