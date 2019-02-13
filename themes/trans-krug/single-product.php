<? get_header();
global $lang;
?>
    <div class="container">
        <div class="title-main text-center wow slideInDown"><? the_title() ?></div>
        <div class="sub-title text-center wow slideInLeft"><? the_field( 'подзаголовок' ) ?></div>
        <div class="indent-before-decor mt-4 dynamic-content wow slideInRight">
			<?= apply_filters( 'the_content', wpautop( get_post_field( 'post_content', $id ), true ) ); ?>
        </div>
    </div>
<? $Trans->views()->feedback() ?>
    <section class="base-section decor-both-line">
        <div class="container">
            <div class="title-main text-center wow slideInDown"
                 data-wow-delay="0.5s"><? the_field( 'заголовок_блоков' ) ?></div>
            <div class="dynamic-content product-content">
				<? while ( have_rows( 'блоки' ) ):the_row() ?>
                    <div class="row align-items-center mb-4">
                        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-3">
                            <img <? repeater_image( 'картинка' ) ?> class="img-fluid d-block mx-auto">
                        </div>
                        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-9">
                            <div class="title-second medium-size mb-3"><? the_sub_field( 'заголовок' ) ?></div>
                            <div><? the_sub_field( 'текст' ) ?></div>
                        </div>
                    </div>
				<? endwhile; ?>
            </div>
        </div>
    </section>
    <section class="last-works blue-gradient wow slideInUp" data-wow-delay="0.5s" data-wow-duration="1s">
        <div class="container">
            <div class="title-main text-center white"><? pll_e( 'Портфолио работ' ) ?></div>
            <div class="owl-carousel owl-theme mt-4 last-works-carousel">
				<? foreach ( get_field( 'портфолио' ) as $post ): ?>
                    <div>
						<? get_template_part( 'views/album' ); ?>
                    </div>
				<? endforeach; ?>
            </div>
        </div>
    </section>
<? $Trans->views()->reviews() ?>
<? get_footer(); ?>