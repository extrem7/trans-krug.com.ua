<? get_header();
global $lang;
?>
    <div class="container">
        <div class="title-main text-center wow slideInDown"><? the_field( 'услуги_1_заголовок', $lang ) ?></div>
        <div class="sub-title text-center wow slideInLeft"><? the_field( 'услуги_1_текст', $lang ) ?></div>
        <div class="category-md-container mt-5 mb-5">
            <div class="category-list sm-indent row justify-content-center">
				<?
				$delay = .4;
				while ( have_posts() ): the_post() ?>
                    <a href="<? the_permalink() ?>" class="col-lg-3 col-md-6 col-sm-6 col-12 category-item wow zoomIn"
                       data-wow-delay="<?= $delay ?>s">
                        <figure>
							<? the_post_thumbnail( null, [ 'class' => 'img-fluid center-block' ] ) ?>
                            <div class="title-second medium-size"><? the_title() ?></div>
                        </figure>
                    </a>
					<? $delay += .2; endwhile; ?>
            </div>
        </div>
    </div>
<? $Trans->views()->feedback() ?>
    <section class="base-section decor-both-line-after-footer">
        <div class="container">
            <div class="title-main text-center wow slideInLeft"><? the_field( 'услуги_2_заголовок', $lang ) ?></div>
            <div class="dynamic-content wow fadeInUp"
                 data-wow-delay="1s"><? the_field( 'услуги_2_текст', $lang ) ?></div>
        </div>
    </section>
<? get_footer() ?>