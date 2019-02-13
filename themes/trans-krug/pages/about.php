<?
/* Template Name: О компании */
get_header();
global $lang;
?>
    <div class="container wow fadeInLeft" data-wow-diration="2s">
        <div class="title-main text-center"><? the_title() ?></div>
        <div class="sub-title text-center"><? the_field( 'подзаголовок' ) ?></div>
        <div class="dynamic-content indent-before-decor">
            <div class="row mt-5">
                <div class="col-xl-6 col-lg-12">
                    <div class="video">
                        <iframe data-lazysrc="<? the_field('видео') ?>" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12">
					<?= apply_filters( 'the_content', wpautop( get_post_field( 'post_content', $id ), true ) ); ?>
                </div>
            </div>
        </div>
    </div>
    <section class="blue-gradient section-sm-indent decor-top-line-inside">
        <div class="container">
            <div class="title-main white text-center"><? pll_e( 'Наши награды' ) ?></div>
            <div class="owl-carousel owl-theme mt-3 reward" id="reward">
				<? while ( have_rows( 'награды' ) ): the_row(); ?>
                    <div>
                        <div class="text-center white">
                            <img <? repeater_image( 'иконка' ) ?> class="mx-auto">
                            <p class="mt-3"><? the_sub_field( 'текст' ) ?></p>
                        </div>
                    </div>
				<? endwhile; ?>
            </div>
        </div>
    </section>
<? $Trans->views()->map(); ?>
<? get_footer() ?>