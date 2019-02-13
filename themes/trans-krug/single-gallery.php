<?
get_header();
global $lang;
$isAlbum = get_post_type() == 'gallery';
?>
    <div class="container wow fadeInUp" data-wow-duration="2s">
        <div class="title-main text-center">
			<? the_field( 'компания' ) ?>
            <div class="sub-title"><? the_field( 'объект' ) ?></div>
        </div>
        <div class="sub-title text-center"><?= apply_filters( 'the_content', wpautop( get_post_field( 'post_content', $id ), true ) ); ?></div>
		<? if ( $isAlbum ): ?>
            <div class="owl-carousel owl-theme mt-5 owl-number" id="gallery-photo">
				<?
				$gallery = get_field( 'галерея' );
				$gallery = array_chunk( $gallery, 12 );
				foreach ( $gallery as $row ): ?>
                    <div>
                        <div class="gallery">
							<? foreach ( $row as $img ): ?>
                                <a data-fancybox="gallery" href="<?= $img['url'] ?>" class="gallery-item"
                                   style="background-image: url('<?= $img['url'] ?>')">
                                    <span class="zoom-photo"><i class="fas fa-search-plus"></i></span>
                                </a>
							<? endforeach; ?>
                        </div>
                    </div>
				<? endforeach; ?>
            </div>
		<? else: ?>
            <div class="video-frame mt-5"><? the_field( 'видео' ) ?></div>
		<? endif; ?>
    </div>
<? get_footer(); ?>