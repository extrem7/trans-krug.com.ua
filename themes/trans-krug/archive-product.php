<? get_header();
global $lang;
?>
    <div class="container">
        <div class="title-main text-center wow slideInDown"><? the_field( 'продукция_1_заголовок', $lang ) ?></div>
        <div class="sub-title text-center wow slideInLeft"><? the_field( 'продукция_1_текст', $lang ) ?></div>
        <div class="category-md-container mt-5 mb-5">
            <div class="row category-list justify-content-center">
				<?
				$delay = .4;
				while ( have_posts() ): the_post() ?>
                    <a href="<? the_permalink() ?>" class="col-md-4 col-sm-6 col-12 category-item wow zoomIn"
                       data-wow-delay="<?= $delay ?>s">
                        <figure>
							<? the_post_thumbnail( null, [ 'class' => 'img-fluid center-block' ] ) ?>
                            <figcaption>
                                <div class="title-second"><? the_title() ?></div>
                                <p><? the_excerpt() ?></p>
                            </figcaption>
                        </figure>
                    </a>
					<? $delay += .2; endwhile; ?>
            </div>
        </div>
    </div>
<? $Trans->views()->feedback() ?>
    <section class="base-section decor-both-line-after-footer">
        <div class="container">
            <div class="title-main text-center wow slideInDown"
                 data-wow-delay=""><? the_field( 'продукция_2_заголовок', $lang ) ?></div>
            <div class="sub-title text-center wow slideInLeft"
                 data-wow-delay="0.5s"><? the_field( 'продукция_2_текст', $lang ) ?></div>
            <div class="category-md-container mt-5">
                <div class="category-list row sm-indent justify-content-center">
					<? while ( have_rows( 'продукция_шаги', $lang ) ):the_row();
						$delay = .8 + get_row_index() * .2;
						$img   = get_sub_field( 'картинка' );
						?>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-12 category-item wow zoomIn"
                             data-wow-delay="<?= $delay ?>s">
                            <figure>
                                <img src="<?= $img['url'] ?>" class="img-fluid center-block" alt="<?= $img['alt'] ?>">
                                <figcaption>
                                    <div class="title-second medium-size">
                                        Шаг <? the_row_index() ?> <? the_sub_field( 'название' ) ?></div>
                                    <p><? the_sub_field( 'текст' ) ?></p>
                                </figcaption>
                            </figure>
                        </div>
					<? endwhile; ?>
                </div>
            </div>
        </div>
    </section>
<? get_footer() ?>