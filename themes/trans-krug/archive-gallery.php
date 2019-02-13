<? get_header();
global $lang;
$title = get_post_type_object( 'gallery' )->labels->menu_name;
$terms = get_terms( 'gallery_cat' );
?>
    <div class="container wow fadeInUp" data-wow-duration="2s">
        <div class="title-main text-center"><?= $title ?></div>
        <div class="sub-title text-center"><? the_field( 'фотогалерея', $lang ) ?></div>
        <nav>
            <div class="nav gallery-filter mt-3 justify-content-center" id="nav-tab">
				<? for ( $i = 0; $i < count( $terms ); $i ++ ): ?>
                    <a class="<?= $i == 0 ? 'active' : '' ?>" data-toggle="tab" href="#nav-<?= $i ?>"
                       aria-selected="true"><?= $terms[ $i ]->name ?></a>
				<? endfor; ?>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
			<? for ( $i = 0; $i < count( $terms ); $i ++ ):
				$albums = $Trans->albums( $terms[ $i ]->term_id );
				?>
                <div class="tab-pane fade <?= $i == 0 ? 'show active' : '' ?>" id="nav-<?= $i ?>">
                    <div class="gallery-photo-carousel owl-carousel owl-theme dots-dark wow zoomIn">
						<?
						$rows = array_chunk( $albums, 12 );
						foreach ( $rows as $row ):
							?>
                            <div class="row mt-4">
								<? foreach ( $row as $post ) {
									get_template_part( 'views/album' );
								}
								wp_reset_query(); ?>
                            </div>
						<? endforeach; ?>
                    </div>
                </div>
			<? endfor; ?>
        </div>
    </div>
<? get_footer() ?>