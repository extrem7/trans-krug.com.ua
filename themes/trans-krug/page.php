<? get_header();
global $lang;
?>
	<div class="container wow zoomIn" data-wow-duration="2s">
		<article class="dynamic-content indent-before-decor">
			<h1 class="title-main text-center"><? the_title() ?></h1>
			<div class="article-text"><?= apply_filters('the_content', wpautop(get_post_field('post_content', $id), true)); ?></div>
		</article>
	</div>
<? $Trans->views()->feedback() ?>
<? get_footer(); ?>