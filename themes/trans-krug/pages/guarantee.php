<?
/* Template Name: Гарантия */
get_header();
global $lang;
?>
    <div class="container wow zoomIn" data-wow-duration="2s">
        <div class="title-main text-center"><? the_title() ?></div>
        <div class="dynamic-content indent-before-decor">
			<? while ( have_rows( 'блоки' ) ):the_row(); ?>
                <div class="d-flex align-items-center garanty-item">
                    <img <? repeater_image( 'иконка' ) ?>>
                    <div><? the_sub_field( 'текст' ) ?></div>
                </div>
			<? endwhile; ?>
        </div>
    </div>
<? $Trans->views()->map(); ?>
<? get_footer() ?>