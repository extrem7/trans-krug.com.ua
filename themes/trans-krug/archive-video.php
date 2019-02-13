<? get_header();
global $lang;
$title = get_post_type_object( 'video' )->labels->menu_name;
?>
    <div class="container wow zoomIn" data-wow-duration="2s">
        <div class="title-main text-center"><?= $title ?></div>
        <div class="sub-title text-center"><? the_field( 'видеогалерея', $lang ) ?></div>
        <div class="row mt-5">
			<?
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					get_template_part( 'views/video' );
				}
			} ?>
        </div>
    </div>
<? get_footer() ?>