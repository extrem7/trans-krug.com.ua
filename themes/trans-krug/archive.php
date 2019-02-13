<? get_header();
global $lang;
$news = get_term( pll_get_term( 1, $lang ) );
?>
    <div class="container wow zoomIn" data-wow-duration="2s">
        <div class="title-main text-center"><?= $news->name ?></div>
        <nav>
            <div class="nav gallery-filter mt-3 justify-content-center" id="nav-tab">
				<? wp_list_categories( [ 'child_of' => $news->term_id, 'title_li' => '' ] ) ?>
            </div>
        </nav>
        <div class="row news mt-4">
			<?
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					get_template_part( 'views/post' );
				}
			} ?>
        </div>
		<? the_posts_pagination( [ 'end_size' => 2, 'mid_size' => 2, 'prev_next' => false ] ); ?>
    </div>
<? get_footer() ?>